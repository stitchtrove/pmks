<?php

namespace App\Http\Integrations\OpenLibrary;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use App\Data\OpenLibrary\BookData;

class GetBookByIsbnRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected string $isbn) {}

    public function resolveEndpoint(): string
    {
        return '/api/books';
    }

    protected function defaultQuery(): array
    {
        return [
            'bibkeys' => 'ISBN:' . $this->isbn,
            'format'  => 'json',
            'jscmd'   => 'data',
        ];
    }

    public function dto(array $data): ?BookData
    {
        $keys = array_keys($data);

        if (empty($keys)) {
            return null;
        }

        // Always take the first key (ISBN:xxx...)
        $isbnKey = $keys[0];

        return BookData::fromApi($data[$isbnKey]);
    }
}
