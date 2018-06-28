<?php

namespace App\Http\Controllers\Blink;

use App\Ignite\Models\Campaign;
use App\Http\Controllers\Controller;

class CampaignReportController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blink.reports.campaigns', [
            'campaigns' => Campaign::orderBy('id', 'desc')->get(),
        ]);
    }
}
