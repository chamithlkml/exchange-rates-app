<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Libraries\ExchangeRatesData;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('currency_label');
            $table->string('symbol');
            $table->float('rate');
        });

        $exchangeRateData = new ExchangeRatesData(
            env('EXCHANGE_RATES_API_ENDPOINT'),
            env('EXCHANGE_RATES_API_KEY')
        );

        $currencyList = $exchangeRateData->getCurrencyList();

        foreach($currencyList as $currency){
            DB::table('exchange_rates')->insert(
                [
                    'currency_label' => $currency->countryName,
                    'symbol' => $currency->symbol,
                    'rate' => 0.0
                ]
            );
        }

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
