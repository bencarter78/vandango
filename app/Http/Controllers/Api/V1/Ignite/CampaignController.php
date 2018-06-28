<?php

namespace App\Http\Controllers\Api\V1\Ignite;

use App\Ignite\Models\Campaign;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(Campaign::orderBy('name')->get());
    }
}
