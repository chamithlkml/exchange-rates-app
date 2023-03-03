<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\ExchangeRatesData;
use Illuminate\Support\Facades\Log;

class ExchangeRate extends Model
{
    use HasFactory;

    /**
     * Retrieve latest exchange rates from the API and update the database and then return the list as an array
     *
     * @return array
     */
    public static function getLatestRates(): array
    {
        $lastUpdatedAt = self::max('updated_at');

        if(is_null($lastUpdatedAt)){
            $lastUpdatedAt = date(DATE_RFC2822);
        }

        $timeDiffInSeconds = time() - strtotime($lastUpdatedAt);

        $latestRates = [];

        Log::info("time diff in seconds: " . $timeDiffInSeconds);

        # If the time difference is less than assigned refresh window then show last updated DB values
        if($timeDiffInSeconds < intval(env('REFRESH_WINDOW')))
        {
            Log::info('reading from database');

            $requiredSymbols = explode(',', env('EXCHANGE_RATES_REQUIRED_CURRENCIES'));

            $allNonEmptyRates = self::whereRaw('updated_at IS NOT NULL')->get();

            foreach($allNonEmptyRates as $nonEmptyRate)
            {
                if(in_array($nonEmptyRate->symbol, $requiredSymbols))
                {
                    $nonEmptyRate->label = $nonEmptyRate->currency_label;
                    array_push($latestRates, $nonEmptyRate);
                }
            }

        }else
        {
            # If the time difference is bigger than assigned refresh window, then retrieve from API
         
            Log::info('reading from API');
            $exchangeRateData = new ExchangeRatesData(
                env('EXCHANGE_RATES_API_ENDPOINT'),
                env('EXCHANGE_RATES_API_KEY')
            );
    
            $latestRates = $exchangeRateData->getRates(env('EXCHANGE_RATES_REQUIRED_CURRENCIES'), env('EXCHANGE_RATES_API_BASE'));
    
            foreach($latestRates as $latestRate)
            {
                $rate = self::where('symbol', '=', $latestRate->symbol);
                $found_rate = $rate->get();
    
                if(count($found_rate) > 0)
                {
                    $latestRate->label = $found_rate[0]->currency_label;
                }
    
                $rate->update(['rate' => $latestRate->rate]);
    
            }
        }
    
        return $latestRates;
    }
}
