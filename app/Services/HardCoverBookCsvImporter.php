<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookReading;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HardCoverBookCsvImporter
{
    /**
     * Maps CSV column headings to Book model fillable fields.
     * Unmapped columns are intentionally ignored.
     */
    private const BOOK_MAP = [
        'Title'            => 'title',
        'Author'           => 'authors',
        'ISBN 13'          => 'isbn',
        'ISBN 10'          => null,     // ignored — prefer ISBN 13
        'Publish Date'     => null,           // no column in DB — add migration if needed
        'Publisher'        => 'publisher',
        'Pages'            => 'number_of_pages',
        'Rating'           => 'rating',
        'Binding'          => null,     // no column in model — extend if needed
        'Genres'           => null,     // no column in model — extend if needed
        'Status'           => 'status',
    ];

    /**
     * Maps CSV column headings to BookReading model fillable fields.
     */
    private const READING_MAP = [
        'Date Started'  => 'started_at',
        'Date Finished' => 'finished_at',
        'Media'         => 'format',
        'Status'        => 'status',
        'Private Notes' => 'notes',
    ];

    /**
     * Normalise a media/format value to a consistent lowercase string.
     * Adjust these mappings to match your application's expected values.
     */
    private const FORMAT_NORMALISE = [
        'physical'   => 'physical',
        'hardcover'  => 'physical',
        'paperback'  => 'physical',
        'book'       => 'physical',
        'print'      => 'physical',
        'ebook'      => 'ebook',
        'e-book'     => 'ebook',
        'digital'    => 'ebook',
        'audiobook'  => 'audiobook',
        'audio'      => 'audiobook',
    ];

    private const BOOK_STATUS_NORMALISE = [
        'read'           => 'read',
        'reading'        => 'read',
        'want to read'   => 'read',
        'to be read'     => 'read',
        'wishlist'       => 'read',
        'did not finish' => 'read',
        'dnf'            => 'read',
    ];

    private const READING_STATUS_NORMALISE = [
        'read'           => 'finished',
        'finished'       => 'finished',
        'reading'        => 'reading',
        'currently reading' => 'reading',
        'did not finish' => 'abandoned',
        'dnf'            => 'abandoned',
        'abandoned'      => 'abandoned',
    ];

    public function import(string $filePath, array $options = [], ?callable $log = null): array
    {
        $log ??= fn () => null;

        $handle = fopen($filePath, 'r');
        $headers = fgetcsv($handle);

        if ($headers === false) {
            throw new \RuntimeException('CSV file is empty or unreadable.');
        }

        // Trim BOM and whitespace from headers (common in exported CSVs)
        $headers = array_map(fn ($h) => trim($h, "\xEF\xBB\xBF "), $headers);

        $stats = [
            'processed'       => 0,
            'books_created'   => 0,
            'books_updated'   => 0,
            'books_skipped'   => 0,
            'readings_created'=> 0,
            'errors'          => 0,
        ];

        while (($row = fgetcsv($handle)) !== false) {
            $stats['processed']++;
            $data = array_combine($headers, $row);

            try {
                DB::beginTransaction();

                [$book, $action] = $this->upsertBook($data, $options);

                match ($action) {
                    'created' => $stats['books_created']++,
                    'updated' => $stats['books_updated']++,
                    'skipped' => $stats['books_skipped']++,
                };

                if ($book && $action !== 'skipped') {
                    $created = $this->createReading($book, $data, $options);
                    if ($created) {
                        $stats['readings_created']++;
                    }
                }

                DB::commit();

                $title = $data['Title'] ?? 'Unknown';
                $log("[{$action}] {$title}", 'info');
            } catch (\Throwable $e) {
                DB::rollBack();
                $stats['errors']++;
                $title = $data['Title'] ?? "row {$stats['processed']}";
                $log("Error on \"{$title}\": {$e->getMessage()}", 'error');
            }
        }

        fclose($handle);

        return $stats;
    }

    /**
     * Find or create/update a Book record.
     *
     * @return array{0: Book|null, 1: string}  [model, action]
     */
    private function upsertBook(array $data, array $options): array
    {
        $bookData = $this->mapColumns($data, self::BOOK_MAP);
        $bookData = $this->castBookData($bookData, $data);

        $isbn = $bookData['isbn'] ?? null;
        $existing = $isbn ? Book::where('isbn', $isbn)->first() : null;

        if ($existing) {
            if ($options['skip_existing'] ?? false) {
                return [null, 'skipped'];
            }

            if ($options['update_existing'] ?? false) {
                if (! ($options['dry_run'] ?? false)) {
                    $existing->update($bookData);
                }
                return [$existing, 'updated'];
            }

            // Default: skip duplicates unless a flag is set
            return [null, 'skipped'];
        }

        if (! ($options['dry_run'] ?? false)) {
            $book = Book::create($bookData);
            return [$book, 'created'];
        }

        return [new Book($bookData), 'created'];
    }

    /**
     * Create a BookReading record linked to the given Book.
     */
    private function createReading(Book $book, array $data, array $options): bool
    {
        $readingData = $this->mapColumns($data, self::READING_MAP);
        $readingData = $this->castReadingData($readingData);

        // Only create a reading if there's at least one date or a meaningful status
        $hasReadingData = ! empty($readingData['started_at'])
            || ! empty($readingData['finished_at'])
            || ! empty($readingData['status']);

        if (! $hasReadingData) {
            return false;
        }

        if (! ($options['dry_run'] ?? false)) {
            $book->readings()->create($readingData);
        }

        return true;
    }

    /**
     * Extract and map values from a CSV row using a column→field map.
     * Null-mapped columns are skipped.
     */
    private function mapColumns(array $data, array $map): array
    {
        $result = [];

        foreach ($map as $csvColumn => $modelField) {
            if ($modelField === null) {
                continue;
            }

            $value = $data[$csvColumn] ?? null;

            if ($value !== null && $value !== '') {
                $result[$modelField] = $value;
            }
        }

        return $result;
    }

    private function castBookData(array $bookData, array $rawRow): array
    {
        if (isset($bookData['number_of_pages'])) {
            $bookData['number_of_pages'] = (int) $bookData['number_of_pages'];
        }

        if (isset($bookData['rating'])) {
            $bookData['rating'] = (float) $bookData['rating'];
        }

        if (isset($bookData['published_date'])) {
            $bookData['published_date'] = $this->parseDate($bookData['published_date']);
        }

        if (isset($bookData['status'])) {
            $bookData['status'] = self::BOOK_STATUS_NORMALISE[strtolower($bookData['status'])] ?? 'read';
        }

        // Fall back to ISBN 10 if ISBN 13 is absent
        if (empty($bookData['isbn']) && ! empty($rawRow['ISBN 10'])) {
            $bookData['isbn'] = $rawRow['ISBN 10'];
        }

        return $bookData;
    }

    private function castReadingData(array $readingData): array
    {
        foreach (['started_at', 'finished_at'] as $field) {
            if (isset($readingData[$field])) {
                $readingData[$field] = $this->parseDate($readingData[$field]);
            }
        }

        if (isset($readingData['format'])) {
            $readingData['format'] = self::FORMAT_NORMALISE[strtolower($readingData['format'])] ?? $readingData['format'];
        }

        if (isset($readingData['status'])) {
            $readingData['status'] = self::READING_STATUS_NORMALISE[strtolower($readingData['status'])] ?? 'finished';
        }

        return $readingData;
    }

    private function parseDate(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Exception) {
            return null;
        }
    }
}