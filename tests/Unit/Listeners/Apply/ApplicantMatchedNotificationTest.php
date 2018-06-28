<?php

namespace Tests\Unit\Listeners\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use Illuminate\Support\Facades\Mail;
use App\Eportfolios\Models\Eportfolio;
use App\Events\Apply\ApplicantWasMatched;
use App\Mail\Apply\OnefileAccountRequiresSyncing;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class ApplicantMatchedNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_when_an_applicant_is_matched_and_requires_a_onfile_sync()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->states('start')->create();
        factory(Eportfolio::class)->create(['applicant_id' => $applicant->id]);

        ApplicantWasMatched::dispatch($applicant);

        Mail::assertSent(OnefileAccountRequiresSyncing::class, function ($mail) {
            return $mail->hasTo(config('vandango.emails.programmeAdmin'));
        });
    }

    /** @test */
    public function it_does_not_send_a_notification_when_an_applicant_is_matched_and_does_not_require_a_onfile_sync()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->states('start')->create();

        ApplicantWasMatched::dispatch($applicant);

        Mail::assertNotSent(OnefileAccountRequiresSyncing::class);
    }

    /** @test */
    public function it_does_not_send_a_notification_when_an_applicant_is_matched_and_the_onefile_account_is_not_created()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->states('start')->create();
        factory(Eportfolio::class)->create(['applicant_id' => $applicant->id, 'username' => null]);

        ApplicantWasMatched::dispatch($applicant);

        Mail::assertNotSent(OnefileAccountRequiresSyncing::class);
    }
}
