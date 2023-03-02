<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Libraries;
use App\Libraries\ExchangeRatesData;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{

    public function show(): View
    {
        $exchangeRateData = new ExchangeRatesData(
            env('EXCHANGE_RATES_API_ENDPOINT'),
            env('EXCHANGE_RATES_API_KEY')
        );

        $latestRates = $exchangeRateData->getRates(env('EXCHANGE_RATES_REQUIRED_CURRENCIES'), env('EXCHANGE_RATES_API_BASE'));

        foreach($latestRates as $latestRate)
        {
            $rate = ExchangeRate::where('symbol', '=', $latestRate->symbol);
            $found_rate = $rate->get();

            if(count($found_rate) > 0)
            {
                Log::info($found_rate[0]->currency_label);
                $latestRate->label = $found_rate[0]->currency_label;
            }

            $rate->update(['rate' => $latestRate->rate]);

        }

        return view('index.show', ['currencies' => $latestRates]);
    }
    
}
