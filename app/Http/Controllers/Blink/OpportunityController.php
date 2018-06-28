<?php

namespace App\Http\Controllers\Blink;

use App\Http\Controllers\Controller;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('blink.opportunities.index');
    }
}
