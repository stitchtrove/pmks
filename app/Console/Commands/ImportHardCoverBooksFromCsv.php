<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\BookReading;
use App\Services\HardCoverBookCsvImporter;
use Illuminate\Console\Command;

class ImportHardCoverBooksFromCsv extends Command
{
    protected $signature = 'books:import
                            {file : Path to the CSV file}
                            {--dry-run : Preview what would be imported without saving}
                            {--skip-existing : Skip books that already exist by ISBN}
                            {--update-existing : Update books that already exist by ISBN}';

    protected $description = 'Import books and reading history from a Hardcover-format CSV file';

    public function handle(HardCoverBookCsvImporter $importer): int
    {
        $file = $this->argument('file');

        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return self::FAILURE;
        }

        $options = [
            'dry_run'         => $this->option('dry-run'),
            'skip_existing'   => $this->option('skip-existing'),
            'update_existing' => $this->option('update-existing'),
        ];

        if ($options['dry_run']) {
            $this->warn('Running in dry-run mode — no data will be saved.');
        }

        $this->info("Importing from: {$file}");
        $this->newLine();

        $result = $importer->import($file, $options, function (string $message, string $type = 'info') {
            match ($type) {
                'warn'    => $this->warn($message),
                'error'   => $this->error($message),
                default   => $this->line("  {$message}"),
            };
        });

        $this->newLine();
        $this->info('Import complete.');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Rows processed',      $result['processed']],
                ['Books created',       $result['books_created']],
                ['Books updated',       $result['books_updated']],
                ['Books skipped',       $result['books_skipped']],
                ['Readings created',    $result['readings_created']],
                ['Rows with errors',    $result['errors']],
            ]
        );

        return self::SUCCESS;
    }
}