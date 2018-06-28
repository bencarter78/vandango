<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * @var string
     */
    protected $pageTitle = 'Auditor';

    /**
     * @var string
     */
    protected $package = 'auditor';

    /**
     *
     */
    public function index()
    {
        return view('auditor.dashboard');
    }

}