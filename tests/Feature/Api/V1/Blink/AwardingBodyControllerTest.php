<?php

namespace Tests\Feature\Api\V1\Blink;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Blink\AwardingBody;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class AwardingBodyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_awarding_bodies()
    {
        $awardingBodyA = factory(AwardingBody::class)->create();
        $awardingBodyB = factory(AwardingBody::class)->create();
        $awardingBodyC = factory(AwardingBody::class)->create();

        $response = $this->json('GET', route('api.blink.awarding-bodies.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertContains($awardingBodyA);
        $response->data('data')->assertContains($awardingBodyB);
        $response->data('data')->assertContains($awardingBodyC);
    }
}
