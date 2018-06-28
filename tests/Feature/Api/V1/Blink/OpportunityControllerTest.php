<?php

namespace Tests\Feature\Api\V1\Blink;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Opportunity;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OpportunityControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_opportunities()
    {
        $opportunityA = $this->create(Opportunity::class, 1, ['expected_on' => Carbon::today()->addDay(1)]);
        $opportunityB = $this->create(Opportunity::class, 1, ['expected_on' => Carbon::today()->addDay(2)]);
        $opportunityC = $this->create(Opportunity::class, 1, ['expected_on' => Carbon::today()->addDay(3)]);

        $response = $this->json('GET', '/api/v1/blink/opportunities');

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertEquals([$opportunityA, $opportunityB, $opportunityC]);
    }
}
