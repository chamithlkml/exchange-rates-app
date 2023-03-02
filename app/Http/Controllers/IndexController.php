<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function show(): View
    {
        $currencies = [
            ['label' => 'Euro', 'rate' => 0.924],
            ['label' => 'British Pound Sterling', 'rate' => 0.775],
            ['label' => 'Japansese Yen', 'rate' => 128.423],
            ['label' => 'Swiss Franc', 'rate' => 0.955],
            ['label' => 'Canadian Dollar', 'rate' => 1.266]
        ];

        return view('index.show', ['currencies' => $currencies]);
    }
    
}
