<?php

namespace Tests\Unit\Jobs\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use App\Mail\Apply\PaperworkIssue;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Apply\NotifyUserPaperworkHasIssue;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class NotifyUserPaperworkHasIssueTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_an_email_to_an_adviser_when_paperwork_for_a_given_learner_has_an_issue()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->create();

        (new NotifyUserPaperworkHasIssue($applicant, $this->user()))->handle();

        Mail::assertSent(PaperworkIssue::class, function ($mail) use ($applicant) {
            return $mail->hasTo($applicant->adviser->email);
        });
    }

    /** @test */
    public function it_ccs_the_programme_admin_helpdesk()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->create();

        (new NotifyUserPaperworkHasIssue($applicant, $this->user()))->handle();

        Mail::assertSent(PaperworkIssue::class, function ($mail) use ($applicant) {
            return $mail->hasTo($applicant->adviser->email) && $mail->hasTo(config('vandango.helpdesk.programmeAdmin'));
        });
    }

    /** @test */
    public function it_sends_an_email_to_the_submittor_when_no_adviser_has_been_identified()
    {
        Mail::fake();

        $applicant = factory(Applicant::class)->create();
        $applicant->adviser_id = null;

        (new NotifyUserPaperworkHasIssue($applicant, $this->user()))->handle();

        Mail::assertSent(PaperworkIssue::class, function ($mail) use ($applicant) {
            return $mail->hasTo($applicant->submittedBy->email);
        });
    }
}
