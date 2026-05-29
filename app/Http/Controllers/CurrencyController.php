<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\CurrencyConversionInterface;

class CurrencyController extends Controller
{
    // Inject via constructor (recommended)
    public function __construct(
        protected CurrencyConversionInterface $currencyService
    ) {}

    // GET /currency
    public function index()
    {
        $currencies = $this->currencyService->getSupportedCurrencies();

        return view('conversion', compact('currencies'));
    }

    // POST /currency/convert
    public function convert(Request $request)
    {
        $request->validate([
            'amount'   => 'required|numeric|min:1',
            'currency' => 'required|string|size:3',
        ]);

        try {
            $converted = $this->currencyService->convert(
                $request->amount,
                $request->currency
            );

            return response()->json([
                'success'       => true,
                'from_amount'   => $request->amount,
                'from_currency' => 'INR',
                'to_currency'   => strtoupper($request->currency),
                'result'        => $converted,
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}

?>