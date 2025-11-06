<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('rich-content-plugins/code-block-lowlight', __DIR__ . '/../../resources/js/dist/filament/rich-content-plugins/code-block-lowlight.js')->loadedOnRequest(),
            Css::make('rich-content-plugins/code-block-lowlight-external-stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.0/styles/tokyo-night-dark.min.css'),
        ]);
    }
}
