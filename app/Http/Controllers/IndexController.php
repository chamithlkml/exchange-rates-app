<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Models\ExchangeRate;

class IndexController extends Controller
{

    public function show(): View
    {   
        $latestRates = ExchangeRate::getLatestRates();

        return view('index.show', ['currencies' => $latestRates]);
    }
}
