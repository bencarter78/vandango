<?php

namespace Tests\Unit\Listeners\Eportfolios;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Eportfolios\Models\Eportfolio;
use App\Mail\Apply\WelcomeToTotalPeople;
use App\Events\Eportfolios\AccountWasCreated;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group eportfolio
 */
class LearnerWelcomeNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_an_email_when_a_new_account_has_been_created()
    {
        Mail::fake();

        $eportfolio = factory(Eportfolio::class)->create();
        $event = $this->mock(AccountWasCreated::class);
        $event->eportfolio = $eportfolio;

        AccountWasCreated::dispatch($eportfolio);

        Mail::assertSent(WelcomeToTotalPeople::class, function ($mail) use ($eportfolio) {
            return $mail->hasTo($eportfolio->applicant->email)
                && $mail->hasCc($eportfolio->applicant->adviser->email);
        });
    }
}
