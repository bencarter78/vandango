<?php

namespace Tests\Unit\Console\Commands\Blink;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Blink;
use Illuminate\Support\Facades\Mail;
use App\Blink\Repositories\Enquiries;
use App\Mail\Blink\AssignEnquiryNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Console\Commands\Blink\CheckForUnassignedEnquiries;

/**
 * @group blink
 */
class CheckForUnassignedEnquiriesTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_for_every_unassigned_enquiry_older_than_X_minutes()
    {
        Mail::fake();

        $enquiry = $this->enquiries();
        $enquiry->created_at = Carbon::now()->subMinutes(500);

        $repository = $this->mock(Enquiries::class);
        $repository->shouldReceive('getUnassigned')->andReturn(collect([$enquiry]));

        (new CheckForUnassignedEnquiries($repository))->handle();

        Mail::assertSent(AssignEnquiryNotification::class, function ($mail) {
            return $mail->hasTo(config('vandango.blink.admin.email'));
        });
    }

    /** @test */
    public function it_only_sends_a_notification_when_the_enquiry_has_not_been_assigned_after_X_minutes()
    {
        Mail::fake();

        $repository = $this->mock(Enquiries::class);
        $repository->shouldReceive('getUnassigned')->andReturn(collect([$this->enquiries()]));

        (new CheckForUnassignedEnquiries($repository))->handle();

        Mail::assertNotSent(AssignEnquiryNotification::class);
    }
}
