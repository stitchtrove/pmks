<?php

namespace App\Data\OpenLibrary;

class BookData
{
    public function __construct(
        public string $title,
        public array $authors,
        public ?int $numberOfPages,
        public ?string $publishDate,
        public ?string $coverLarge,
        public ?string $coverMedium,
        public ?string $coverSmall,
        public array $publisher,
        public ?string $description,
    ) {}

    public static function fromApi(array $data): self
    {
        return new self(
            title: $data['title'] ?? '',
            authors: array_map(
                fn ($author) => $author['name'] ?? '',
                $data['authors'] ?? []
            ),
            numberOfPages: $data['number_of_pages'] ?? null,
            publishDate: $data['publish_date'] ?? null,
            coverLarge: $data['cover']['large'] ?? null,
            coverMedium: $data['cover']['medium'] ?? null,
            coverSmall: $data['cover']['small'] ?? null,
            publisher: array_map(
                fn ($publisher) => $publisher['name'] ?? '',
                $data['publishers'] ?? []
            ),
            description: is_array($data['description'] ?? null)
                ? ($data['description']['value'] ?? null)
                : ($data['description'] ?? null),
        );
    }
}
