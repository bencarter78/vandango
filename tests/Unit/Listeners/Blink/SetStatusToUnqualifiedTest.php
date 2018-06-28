<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use App\UserManager\Users\User;
use App\Events\Blink\AccountManagerWasUpdated;
use App\Listeners\Blink\SetStatusToUnqualified;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class SetStatusToUnqualifiedTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_progresses_the_enquiry_status_when_an_account_manager_is_assigned()
    {
        $user = factory(User::class)->create();
        factory(Status::class)->create(['name' => config('vandango.blink.statuses.unqualified')]);
        $status = factory(Status::class)->create(['name' => config('vandango.blink.statuses.pending')]);
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addStatus($status, $user->id);

        $event = $this->mock(AccountManagerWasUpdated::class);
        $event->enquiry = $enquiry;
        $event->user = $user;

        $listener = new SetStatusToUnqualified();
        $listener->handle($event);

        $this->assertTrue($status->is($event->enquiry->status()));
    }
}
