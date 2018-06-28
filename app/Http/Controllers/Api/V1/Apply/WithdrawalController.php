<?php

namespace App\Http\Controllers\Api\V1\Apply;

use App\Apply\Models\Withdrawal;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(Withdrawal::orderBy('name')->get());
    }
}
