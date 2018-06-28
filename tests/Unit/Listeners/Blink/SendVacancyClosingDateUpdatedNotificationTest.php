<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use Illuminate\Support\Facades\Mail;
use App\Mail\Blink\VacancyClosingDateUpdated;
use App\Events\Blink\VacancyClosingDateWasChanged;
use App\Listeners\Blink\SendVacancyClosingDateUpdatedNotification;

/**
 * @group blink
 */
class SendVacancyClosingDateUpdatedNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification_when_a_vacancy_closing_date_has_been_updated()
    {
        Mail::fake();

        $vacancy = $this->mock(Vacancy::class);
        $event = new VacancyClosingDateWasChanged($vacancy);
        $listener = new SendVacancyClosingDateUpdatedNotification();
        $listener->handle($event);

        Mail::assertSent(VacancyClosingDateUpdated::class, function ($mail) {
            return $mail->hasTo(config('vandango.blink.vacancies.email'));
        });
    }
}
