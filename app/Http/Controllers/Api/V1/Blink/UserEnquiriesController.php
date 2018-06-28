<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Repositories\Users;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Enquiries;

class UserEnquiriesController extends Controller
{
    /**
     * @var Enquiries
     */
    protected $repository;

    /**
     * UserEnquiriesController constructor.
     *
     * @param $repository
     */
    public function __construct(Users $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $enquiries = $this->repository->getLiveEnquiries($id);

        return response()->json([
            'ok' => true,
            'total' => $enquiries->count(),
            'results' => $enquiries->toArray(),
        ], 200);
    }
}
