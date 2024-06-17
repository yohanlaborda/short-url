<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Url\Application\ShortUrlGenerator;
use Url\Domain\UrlProvider;
use Url\Infrastructure\TinyUrl\TinyUrlProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TinyUrlProvider::class,
            static function (Application $application) {
                return new TinyUrlProvider(
                    $application->make(Client::class),
                    config('app.urlProvider.tinyUrl')
                );
            }
        );

        $this->app->when(ShortUrlGenerator::class)
            ->needs(UrlProvider::class)
            ->give(
                static function (Application $application) {
                    return [
                        $application->make(TinyUrlProvider::class),
                    ];
                }
            );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
