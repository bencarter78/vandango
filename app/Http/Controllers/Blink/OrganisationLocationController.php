<?php

namespace App\Http\Controllers\Blink;

use App\Blink\Models\Organisation;
use App\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Requests\Locations\LocationRequest;

class OrganisationLocationController extends Controller
{
    /**
     * @var Location
     */
    protected $model;

    /**
     * OrganisationLocationController constructor.
     *
     * @param $model
     */
    public function __construct(Location $model)
    {
        $this->model = $model;
    }

    /**
     * @param LocationRequest $request
     * @param                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocationRequest $request, $id)
    {
        Organisation::findOrFail($id)->locations()->create($request->all());

        return redirect()
            ->route('blink.organisations.show', $id)
            ->with('success', 'You have successfully added a new location');
    }
}
