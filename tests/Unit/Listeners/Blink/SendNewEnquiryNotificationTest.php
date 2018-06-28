<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\EnquiryWasAdded;
use App\Mail\Blink\AssignEnquiryNotification;
use App\Listeners\Blink\SendNewEnquirySubmittedNotification;

/**
 * @group blink
 */
class SendNewEnquiryNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification_when_a_new_enquiry_is_added()
    {
        Mail::fake();

        $event = $this->mock(EnquiryWasAdded::class);
        $event->enquiry = $this->mock(Enquiry::class);

        $listener = new SendNewEnquirySubmittedNotification($event);
        $listener->handle($event);

        Mail::assertSent(AssignEnquiryNotification::class, function ($mail) {
            return $mail->hasTo(config('vandango.blink.admin.email'));
        });
    }
}
