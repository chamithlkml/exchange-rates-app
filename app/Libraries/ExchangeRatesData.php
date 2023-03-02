<?php
namespace App\Libraries;
use Illuminate\Support\Facades\Log;

class ExchangeRatesData{
    
    public function __construct(
        private string $api_url,
        private string $api_key
    ){}

    /**
     * Returns the list of all currency list with symbol and country name
     *
     * @return array
     */
    public function getCurrencyList(): array
    {
        $currencyList = [];

        $rest = new Rest(
            $this->api_url,
            $this->api_key
        );

        $currencyListResponse = $rest->get("symbols");

        # Throw an error if the resposne is invalid
        if(!$currencyListResponse->success)
        {
            throw new \Exception($currencyListResponse->message);
        }

        foreach($currencyListResponse->symbols as $symbol=>$countryName)
        {   
            $currency = new \stdClass();
            $currency->symbol = $symbol;
            $currency->countryName = $countryName;

            array_push($currencyList, $currency);
        }

        return $currencyList;
    }

    /**
     * Returns the latest exchange rate based on the provided base currency
     *
     * @param string $commaSeparatedSymbols
     * @param string $base
     * @return array
     */
    public function getRates(string $commaSeparatedSymbols='', string $base='USD'): array
    {
        $rates = [];

        $rest = new Rest(
            $this->api_url,
            $this->api_key
        );

        $ratesResponse = $rest->get("latest", "base={$base}&symbols={$commaSeparatedSymbols}");

        # Throw an error if the response is invalid
        if(!$ratesResponse->success)
        {
            throw new \Exception($ratesResponse->message);
        }

        foreach($ratesResponse->rates as $symbol=>$rate)
        {
            $currency = new \stdClass();
            
            $currency->symbol = $symbol;
            $currency->rate = $rate;

            array_push($rates, $currency);
        }

        return $rates;
    }

}