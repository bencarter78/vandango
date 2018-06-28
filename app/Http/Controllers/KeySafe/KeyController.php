<?php

namespace App\Http\Controllers\KeySafe;

use App\KeySafe\Models\Key;
use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('keysafe.keys.index', [
            'keys' => Key::onlyTrashed()->get(),
        ]);
    }

}
