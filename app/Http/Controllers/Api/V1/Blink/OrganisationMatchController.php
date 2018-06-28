<?php

namespace App\Http\Controllers\Api\V1\Blink;

use Illuminate\Http\Request;
use App\Blink\Models\Organisation;
use App\Pics\Organisation as Client;
use App\Http\Controllers\Controller;

class OrganisationMatchController extends Controller
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * OrganisationMatchController constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $response = $this->client->search(['EmployerName' => Organisation::findOrFail($id)->name]);

        return $this->response([
            'page' => $response->PageNumber,
            'total' => $response->TotalRecordCount,
            'results' => $response->Results,
        ]);
    }

    /**
     * @param Organisation $organisation
     * @param Request      $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Organisation $organisation, Request $request)
    {
        $this->validate($request, ['organisation' => 'required']);
        $this->saveOrganisation($organisation);
        $this->saveLocation($organisation);

        return $this->response($organisation);
    }

    /**
     * @param Organisation $organisation
     */
    private function saveOrganisation(Organisation $organisation)
    {
        $organisation->update([
            'datastore_ref' => request('organisation.Place'),
            'name' => request('organisation.Name'),
            'tel' => request('organisation.Phone'),
            'email' => request('organisation.Email'),
            'alias' => $organisation->addAliases(request('organisation.Name')),
            'edrs' => request('organisation.EDRSReference'),
        ]);
    }

    /**
     * @param Organisation $organisation
     */
    private function saveLocation(Organisation $organisation)
    {
        $organisation->locations()->updateOrCreate([
            'add1' => request('organisation.Address.Address1'),
            'postcode' => request('organisation.PostCode'),
        ], [
            'add1' => request('organisation.Address.Address1'),
            'add2' => request('organisation.Address.Address2'),
            'add3' => request('organisation.Address.Address3'),
            'town' => request('organisation.Address.Address4'),
            'county' => request('organisation.Address.Address5'),
            'postcode' => request('organisation.PostCode'),
        ]);
    }
}
