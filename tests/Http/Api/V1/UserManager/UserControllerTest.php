<?php

namespace Tests\Http\Api\V1\UserManager;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class UserControllerTest extends BrowserKitTest
{
    use DatabaseMigrations, DatabaseTransactions;

    protected $baseUri = '/api/v1/usermanager/users';

    /** @test */
    function it_returns_all_users_as_json()
    {
        \Redis::del('users.all');
        $user = $this->user();
        $this->visit($this->baseUri)->seeJson(['email' => $user->email]);
    }

    /** @test */
    function it_returns_a_user_from_an_ID()
    {
        $user = $this->user();
        $this->visit($this->baseUri . '/' . $user->id)->seeJson(['email' => $user->email]);
    }

}
