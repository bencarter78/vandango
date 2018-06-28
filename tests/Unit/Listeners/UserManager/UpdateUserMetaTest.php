<?php

namespace Tests\Unit\Listeners\UserManager;

use Tests\TestCase;
use App\Events\UserManager\UserWasUpdated;
use App\Listeners\UserManager\UpdateUserMeta;
use App\Http\Requests\UserManager\StoreUserRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class UpdateUserMetaTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_updates_a_users_meta_information()
    {
        $user = $this->user();

        $request = $this->mock(StoreUserRequest::class);
        $request->shouldReceive('get')->with('tel')->andReturn('01234567890');
        $request->shouldReceive('get')->with('mobile')->andReturn('07123456789');
        $request->shouldReceive('get')->with('ext')->andReturn('+101');

        $event = $this->mock(UserWasUpdated::class);
        $event->shouldReceive('getUser')->andReturn($user);
        $event->shouldReceive('getCommand')->andReturn($request);

        $listener = new UpdateUserMeta();
        $listener->handle($event);

        $this->assertEquals('01234567890', $user->meta->tel);
    }
}