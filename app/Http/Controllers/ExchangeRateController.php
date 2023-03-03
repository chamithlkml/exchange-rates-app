<?php

namespace App\Http\Controllers;
use App\Libraries\ExchangeRatesData;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Log;

class ExchangeRateController extends Controller
{
    public function index(): array
    {
        return ExchangeRate::getLatestRates();
    }
}
