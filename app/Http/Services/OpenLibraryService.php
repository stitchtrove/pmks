<?php

namespace App\Http\Services;

use App\Http\Integrations\OpenLibrary\OpenLibraryConnector;
use App\Http\Integrations\OpenLibrary\GetBookByIsbnRequest;
use App\Data\OpenLibrary\BookData;

class OpenLibraryService
{
    public function getBookByIsbn(string $isbn): ?BookData
    {
        $isbn = str_replace('-', '', $isbn); // normalize

        try {
            $connector = new OpenLibraryConnector();
            $request = new GetBookByIsbnRequest($isbn);

            $response = $connector->send($request);

            $data = $response->json();

            return $request->dto($data);

        } catch (\Throwable $e) {
            dd('Exception: ' . $e->getMessage());
        }
    }
}