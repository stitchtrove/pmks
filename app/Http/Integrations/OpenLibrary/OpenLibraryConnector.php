<?php

namespace App\Http\Integrations\OpenLibrary;

use Saloon\Http\Connector;

class OpenLibraryConnector extends Connector
{
    /**
     * Base URL for Open Library API
     */
    public function resolveBaseUrl(): string
    {
        return 'https://openlibrary.org';
    }
}