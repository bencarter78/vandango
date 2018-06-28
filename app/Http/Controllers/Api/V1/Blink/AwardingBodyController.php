<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\AwardingBody;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AwardingBodyController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(AwardingBody::orderBy('name')->get());
    }
}
