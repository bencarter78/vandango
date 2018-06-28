<?php

namespace Tests\Http\Api\V1\UserManager;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class UserSearchTest extends BrowserKitTest
{
    use DatabaseMigrations;

    protected $baseUri = '/api/v1/usermanager/users';

    /** @test */
    function it_returns_a_user_when_searching_for_part_of_their_name()
    {
        $user = $this->user();
        $this->visit($this->baseUri . '/search?q=' . $user->first_name)->seeJson(['email' => $user->email]);
    }

    /** @test */
    function it_returns_a_user_when_searching_for_the_department()
    {
        $department = $this->departments();
        $user = $this->user(['departments' => $department->id]);
        $this->visit($this->baseUri . '/search?q=' . $department->department)->seeJson(['email' => $user->email]);
    }

    /** @test */
    function it_returns_a_user_when_searching_for_the_sector()
    {
        $sector = $this->sectors();
        $user = $this->user(['sectors' => $sector->id]);
        $this->visit($this->baseUri . '/search?q=' . $sector->name)->seeJson(['email' => $user->email]);
    }

}
