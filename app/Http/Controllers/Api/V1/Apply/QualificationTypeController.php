<?php

namespace App\Http\Controllers\Api\V1\Apply;

use App\Http\Controllers\Controller;
use App\Apply\Models\QualificationType;

class QualificationTypeController extends Controller
{
    /**
     * @var QualificationType
     */
    protected $model;

    /**
     * QualificationTypeController constructor.
     *
     * @param $model
     */
    public function __construct(QualificationType $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            request('type') ? $this->model->where(request('type'), true)->get() : $this->model->all()
        );
    }
}
