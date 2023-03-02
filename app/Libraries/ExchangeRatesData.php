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

}