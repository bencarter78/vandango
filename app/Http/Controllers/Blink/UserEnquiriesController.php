<?php

namespace App\Http\Controllers\Blink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserEnquiriesController extends Controller
{
    public function index()
    {
        return view('blink/dashboards/user');
    }
}
