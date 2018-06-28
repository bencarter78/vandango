<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasApproved;
use App\Mail\Blink\VacancyRequiresPosting;
use App\Listeners\Blink\SendVacancyRequiresPostingNotification;

/**
 * @group blink
 */
class SendVacancyRequiresPostingNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification_that_the_vacancy_should_be_posted_to_NAS()
    {
        Mail::fake();

        $event = $this->mock(VacancyWasApproved::class);
        $event->vacancy = $this->mock(Vacancy::class);

        (new SendVacancyRequiresPostingNotification())->handle($event);

        Mail::assertSent(VacancyRequiresPosting::class, function ($mail) {
            return $mail->hasTo(config('vandango.blink.vacancies.email'));
        });
    }
}
