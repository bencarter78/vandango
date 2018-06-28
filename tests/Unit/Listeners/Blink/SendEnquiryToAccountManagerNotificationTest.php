<?php

namespace Tests\Unit\Listeners\Blink;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\User;
use App\Blink\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\Blink\EnquiryAssignment;
use App\Events\Blink\AccountManagerWasUpdated;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\Blink\SendEnquiryAssignedToAccountManagerNotification;

/**
 * @group blink
 */
class SendEnquiryToAccountManagerNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
        Mail::fake();
    }

    /** @test */
    public function it_sends_a_notification_to_the_newly_assigned_account_manager()
    {
        $user = factory(User::class)->create(['email' => 'test@test.com']);

        $enquiry = factory(Enquiry::class)->create();
        $enquiry->owners()->attach($user->id, ['updated_by' => $user->id]);
        $enquiry->activities()->create([
            'note' => 'Some amazing note',
            'due_at' => Carbon::now(),
            'updated_by' => $user->id,
        ]);

        $event = $this->mock(AccountManagerWasUpdated::class);
        $event->user = $user;
        $event->enquiry = $enquiry;

        $listener = new SendEnquiryAssignedToAccountManagerNotification();
        $listener->handle($event);

        Mail::assertSent(EnquiryAssignment::class, function ($mail) {
            return $mail->hasTo('test@test.com');
        });
    }
}
