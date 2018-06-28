<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Cpd\Organisation;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationSearchControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_organisations_matching_a_search_term()
    {
        $organisationA = factory(Organisation::class)->create(['name' => 'ABC Ltd']);
        $organisationB = factory(Organisation::class)->create(['name' => 'ABCDE Services']);
        $organisationC = factory(Organisation::class)->create(['name' => 'XYZ Consultants']);

        $response = $this->json('GET', route('api.cpd.organisations.search'), ['q' => 'abc']);

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($organisationA);
        $response->data('data')->assertContains($organisationB);
        $response->data('data')->assertNotContains($organisationC);
    }
}
