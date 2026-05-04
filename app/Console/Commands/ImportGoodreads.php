<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\BookReading;
use Illuminate\Support\Facades\DB;

class ImportGoodreads extends Command
{
    protected $signature = 'goodreads:import {file}';
    protected $description = 'Import Goodreads CSV';

    public function handle()
    {
        $path = $this->argument('file');

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }

        $handle = fopen($path, 'r');

        $headers = fgetcsv($handle);

        $count = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            // 🔑 ONLY import books marked as "read"
            if (($data['Exclusive Shelf'] ?? null) !== 'read') {
                continue;
            }

            DB::transaction(function () use ($data, &$count) {

                $book = Book::firstOrCreate(
                    [
                        'title' => $data['Title'],
                        'authors' => $data['Author'],
                    ],
                    [
                        'isbn' => $this->cleanIsbn($data['ISBN13'] ?: $data['ISBN']),
                        'published_year' => $data['Year Published'] ?: null,
                        'number_of_pages' => $data['Number of Pages'] ?: null,
                        'publisher' => $data['Publisher'] ?: null,
                        'rating' => $data['My Rating'] ?: null,
                        'status' => 'read',
                    ]
                );

                BookReading::create([
                    'book_id' => $book->id,
                    'started_at' => $this->parseDate($data['Date Added']),
                    'finished_at' => $this->parseDate($data['Date Read']),
                    'format' => $this->mapFormat($data['Binding']),
                    'status' => 'finished',
                    'notes' => $data['My Review'] ?: null,
                ]);

                $count++;
            });
        }

        fclose($handle);

        $this->info("Imported {$count} books");

        return 0;
    }

    private function cleanIsbn($isbn)
    {
        if (!$isbn) {
            return null;
        }

        $isbn = trim($isbn, '="');

        // Catch Goodreads junk values
        if ($isbn === '' || $isbn === '0') {
            return null;
        }

        return $isbn;
    }

    private function mapFormat($binding)
    {
        if (!$binding) {
            return null;
        }

        $binding = strtolower($binding);

        return match (true) {
            str_contains($binding, 'kindle'),
            str_contains($binding, 'ebook'),
            str_contains($binding, 'e-book') => 'ebook',

            str_contains($binding, 'audio'),
            str_contains($binding, 'audible') => 'audiobook',

            default => 'physical',
        };
    }

    private function parseDate($date)
    {
        if (!$date) return null;

        return \Carbon\Carbon::createFromFormat('Y/m/d', $date)->format('Y-m-d');
    }
}