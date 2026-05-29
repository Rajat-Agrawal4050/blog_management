<?php

namespace App\Services;
use App\Services\Contracts\CurrencyConversionInterface;

class CurrencyConverterService implements CurrencyConversionInterface
{
    
protected array $rates;

 public function __construct()
    {
        // In real app, fetch from an API or config
        $this->rates = [
            'USD' => 0.012,
            'EUR' => 0.011,
            'GBP' => 0.0094,
        ];
    }

    public function convert(float $amount, string $toCurrency): float
    {
        // conversion logic
        $currency = strtoupper($toCurrency);

         if (!isset($this->rates[$currency])) {
            throw new \InvalidArgumentException("Unsupported currency: $currency");
        }
        return round($amount * $this->rates[$currency],2);
    }

     public function getSupportedCurrencies(): array
    {
        return array_keys($this->rates);
    }
}