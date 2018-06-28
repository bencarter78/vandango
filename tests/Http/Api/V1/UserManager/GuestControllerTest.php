<?php

namespace Tests\Http\Api\V1\UserManager;

use Tests\BrowserKitTest;
use App\Classroom\Models\Guest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class GuestControllerTest extends BrowserKitTest
{
    use DatabaseTransactions;

    protected $baseUri = '/api/v1/usermanager/guests';

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    function it_returns_all_guests_as_json()
    {
        $guest = factory(Guest::class)->create();
        $this->visit($this->baseUri)->seeJson(['email' => $guest->email]);
    }

    /** @test */
    function it_returns_a_guest_from_an_ID()
    {
        $guest = factory(Guest::class)->create();
        $this->visit($this->baseUri . '/' . $guest->id)->seeJson(['email' => $guest->email]);
    }

    /** @test */
    function it_creates_a_new_guest()
    {
        $guest = factory(Guest::class)->make();
        $this->json('POST', $this->baseUri, [
            'email' => $guest->email,
            'first_name' => $guest->first_name,
            'surname' => $guest->surname,
        ])->seeJson(['email' => $guest->email]);
    }

    /** @test */
    function it_returns_an_error_when_required_field_is_missing()
    {
        $guest = factory(Guest::class)->make();
        $this->json('POST', $this->baseUri, [
            'email' => $guest->email,
            'surname' => $guest->surname,
        ])->dontSeeJson(['email' => $guest->email]);
    }

}
