<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CurrencyConverterService;
use App\Services\Contracts\CurrencyConversionInterface;

class CurrencyConversionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
          // Bind the interface to the concrete implementation
        $this->app->singleton(CurrencyConversionInterface::class, function ($app) {
            return new CurrencyConverterService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
