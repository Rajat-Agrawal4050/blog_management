<?php

namespace App\Services\Contracts;

interface CurrencyConversionInterface
{
    public function convert(float $amount, string $toCurrency): float;
    public function getSupportedCurrencies(): array;
}