<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Blink\Models\Organisation;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationMatchControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /**
     * @return array
     */
    private function matchedPicsOrganisation()
    {
        return [
            'organisation' => [
                'Place' => '12345',
                'Name' => 'Test Organisation Ltd',
                'Phone' => '01234567890',
                'Email' => 'info@test-organisation.com',
                'EDRSReference' => 'my-edrs-number',
                'Address' => [
                    'Address1' => '123 Test Road',
                    'Address2' => 'Test Building',
                    'Address3' => 'Testville',
                    'Address4' => 'Test City',
                    'Address5' => 'Testshire',
                ],
                'PostCode' => 'TS1 3ST'
            ],
        ];
    }

    /** @test */
    public function it_returns_all_datastore_organisations_that_match_a_given_term()
    {
        $response = $this->json('GET', route('api.blink.organisations.match.show', factory(Organisation::class)->create()->id));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_links_an_organisation_to_the_datastore_organisation()
    {
        $organisation = factory(Organisation::class)->create(['name' => 'ABC Ltd']);

        $response = $this->json('PUT', route('api.blink.organisations.match.update', $organisation->id), $this->matchedPicsOrganisation());

        $organisation = $organisation->fresh();
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('12345', $organisation->datastore_ref);
        $this->assertEquals('Test Organisation Ltd', $organisation->name);
        $this->assertEquals('ABC Ltd', $organisation->alias);
        $this->assertEquals('01234567890', $organisation->tel);
        $this->assertEquals('info@test-organisation.com', $organisation->email);
        $this->assertEquals('my-edrs-number', $organisation->edrs);
    }

    /** @test */
    public function it_creates_a_new_location_when_a_match_does_not_exist()
    {
        $organisation = factory(Organisation::class)->states('unmatched')->create(['name' => 'ABC Ltd']);

        $this->json('PUT', route('api.blink.organisations.match.update', $organisation->id), $this->matchedPicsOrganisation());

        $this->assertCount(1, $organisation->locations);
    }

    /** @test */
    public function it_validates_a_datastore_ref_is_sent_before_updating()
    {
        $response = $this->json('PUT', route('api.blink.organisations.match.update', factory(Organisation::class)->create()->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
