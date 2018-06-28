<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class UserEnquiriesControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_enquiries_for_a_given_user()
    {
        $response = $this->json('get', "api/v1/blink/users/{$this->user()->id}/enquiries");

        $response->assertStatus(Response::HTTP_OK);
    }
}
