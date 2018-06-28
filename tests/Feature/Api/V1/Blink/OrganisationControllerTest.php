<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Organisation;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_organisations()
    {
        $organisations = $this->create(Organisation::class);

        $response = $this->actingAs($this->user())->json('GET', '/api/v1/blink/organisations');

        $response->assertStatus(200);
        $response->assertJson(['results' => [$organisations->toArray()]]);
    }

    /** @test */
    public function it_returns_all_organisations_that_match_a_given_term()
    {
        $organisations = $this->create(Organisation::class, 1, ['name' => 'ABC Ltd']);

        $response = $this->actingAs($this->user())->json('GET', '/api/v1/blink/organisations', ['query' => 'abc']);

        $response->assertStatus(200);
        $response->assertJson(['results' => [$organisations->toArray()]]);
    }
}
