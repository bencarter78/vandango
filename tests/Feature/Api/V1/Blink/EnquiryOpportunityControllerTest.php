<?php

namespace Tests\Feature\Api\V1\Blink;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Blink\Models\Opportunity;
use App\Jobs\Blink\ProgressEntity;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiryOpportunityControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_opportunity()
    {
        $this->expectsJobs(ProgressEntity::class);

        $enquiry = $this->enquiries();
        $unqualified = factory(Status::class)->states('live', 'enquiry')->create([
            'name' => config('vandango.blink.statuses.unqualified'),
            'order' => 1,
        ]);
        $enquiry->statuses()->attach($unqualified->id, ['updated_by' => 1]);
        $opportunity = factory(Opportunity::class)->make(['enquiry_id' => $enquiry->id])->toArray();
        $opportunity['expected_on'] = Carbon::today()->addDays(rand(1, 365))->format('d/m/Y');

        $response = $this->json('POST', "/api/v1/blink/enquiries/{$enquiry->id}/opportunities", $opportunity);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'enquiry_id' => $opportunity['enquiry_id'],
                'sector_id' => $opportunity['sector_id'],
                'quantity' => $opportunity['quantity'],
                'value' => $opportunity['value'],
            ],
        ]);
    }
}
