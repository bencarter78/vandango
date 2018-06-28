<?php

namespace App\Http\Controllers\Api\V1\Blink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blink\Repositories\Organisations;

class OrganisationController extends Controller
{
    /**
     * @var
     */
    protected $organisations;

    /**
     * OrganisationController constructor.
     *
     * @param $organisations
     */
    public function __construct(Organisations $organisations)
    {
        $this->organisations = $organisations;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $organisations = $request->has('q')
            ? $this->organisations->searchBy('name', $request->get('q'))
            : $this->organisations->getAll('name');

        return response()->json([
            'ok' => true,
            'results' => $organisations->load('locations'),
        ], 200);
    }
}
