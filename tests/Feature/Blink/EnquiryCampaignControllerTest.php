<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use App\Blink\Models\Enquiry;
use App\Ignite\Models\Campaign;
use App\UserManager\Users\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiryCampaignControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_attaches_a_campaign_to_the_enquiry()
    {
        $user = $this->user();
        $campaign = factory(Campaign::class)->create();
        $enquiry = factory(Enquiry::class)->create();

        $response = $this->actingAs($user)->put(route('blink.enquiries.campaigns.update', $enquiry->id), [
            'campaign_id' => $campaign->id,
        ]);

        $this->assertTrue($enquiry->fresh()->campaign->is($campaign));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_adds_an_activity_to_the_enquiry()
    {
        $user = factory(User::class)->create(['first_name' => 'Test', 'surname' => 'McTest']);
        $campaign = factory(Campaign::class)->create(['name' => 'Example']);
        $enquiry = factory(Enquiry::class)->create();

        $this->actingAs($user)->put(route('blink.enquiries.campaigns.update', $enquiry->id), [
            'campaign_id' => $campaign->id,
        ]);

        $this->assertEquals($enquiry->fresh()->activities->last()->note, 'Test McTest assigned it to the Example campaign.');
    }
}
