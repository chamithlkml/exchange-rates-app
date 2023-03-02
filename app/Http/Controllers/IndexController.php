<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function show(): View
    {
        return view('index.show', ['name' => 'Chamith']);
    }
    
}
