<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use App\Mail\Blink\VacancyRejected;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasRejected;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Listeners\Blink\SendVacancyRejectedNotification;

/**
 * @group blink
 */
class SendVacancyRejectedNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
        Mail::fake();
    }

    /** @test */
    public function it_sends_a_notification_to_the_enquiry_owner_when_a_vacancy_has_been_rejected()
    {
        $vacancy = factory(Vacancy::class)->create();
        $vacancy->enquiry->owners()->attach($vacancy->submitted_by, ['updated_by' => $vacancy->submitted_by]);

        $event = $this->mock(VacancyWasRejected::class);
        $event->vacancy = $vacancy;

        $listener = new SendVacancyRejectedNotification();
        $listener->handle($event);

        Mail::assertSent(VacancyRejected::class, function ($mail) use ($vacancy) {
            return $mail->hasTo($vacancy->enquiry->owners->last()->email);
        });
    }
}
