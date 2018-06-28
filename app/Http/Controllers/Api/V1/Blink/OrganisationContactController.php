<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Http\Controllers\Controller;
use App\Blink\Repositories\Organisations;

class OrganisationContactController extends Controller
{
    /**
     * @var Organisations
     */
    protected $organisations;

    /**
     * OrganisationContactController constructor.
     *
     * @param $organisations
     */
    public function __construct(Organisations $organisations)
    {
        $this->organisations = $organisations;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index($id)
    {
        return response([
            'ok' => true,
            'results' => $this->organisations->requireById($id)->contacts,
        ], 200);
    }
}
