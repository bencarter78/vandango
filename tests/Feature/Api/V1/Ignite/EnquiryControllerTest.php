<?php

namespace Tests\Feature\Api\V1\Ignite;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Enquiry;
use App\Ignite\Models\Campaign;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnquiryControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_enquiries_linked_to_a_campaign()
    {
        $campaign = factory(Campaign::class)->create();
        $enquiryA = factory(Enquiry::class)->create(['campaign_id' => $campaign->id]);
        $enquiryB = factory(Enquiry::class)->create();
        $enquiryC = factory(Enquiry::class)->create(['campaign_id' => $campaign->id]);

        $response = $this->actingAs($this->user())->json('GET', '/api/v1/ignite/enquiries', ['campaign_id' => $campaign->id]);

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($enquiryA);
        $response->data('data')->assertContains($enquiryC);
        $response->data('data')->assertNotContains($enquiryB);
    }

    /** @test */
    public function a_campaign_id_is_required()
    {
        $response = $this->actingAs($this->user())->json('GET', '/api/v1/ignite/enquiries');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('campaign_id');
    }

    /** @test */
    public function dates_must_be_format_d_m_Y()
    {
        $response = $this->actingAs($this->user())->json('GET', '/api/v1/ignite/enquiries', [
            'campaign_id' => 123,
            'from' => Carbon::now()->subMonth()->format('d/m/y'),
            'to' => Carbon::now()->format('Y-m-d'),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertHasError('from');
        $response->assertHasError('to');
    }

    /** @test */
    public function it_returns_soft_deleted_enquiries()
    {
        $campaign = factory(Campaign::class)->create();
        $enquiryA = factory(Enquiry::class)->create(['campaign_id' => $campaign->id]);
        $enquiryA->delete();
        $enquiryB = factory(Enquiry::class)->create(['campaign_id' => $campaign->id]);

        $response = $this->actingAs($this->user())->json('GET', '/api/v1/ignite/enquiries', ['campaign_id' => $campaign->id]);

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($enquiryA);
        $response->data('data')->assertContains($enquiryB);
    }
}
