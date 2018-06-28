<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use Illuminate\Support\Facades\Mail;
use App\Events\Blink\VacancyWasDeleted;
use App\Listeners\Blink\NotifyUsersVacancyDeleted;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Mail\Blink\SendVacancyRequiresWithdrawingNotification;

/**
 * @group blink
 */
class NotifyUsersVacancyDeletedTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_when_a_vacancy_has_been_deleted()
    {
        Mail::fake();
        $status = factory(Status::class)->states('vacancy', 'closed')->create();
        $vacancy = factory(Vacancy::class)->create();
        $vacancy->statuses()->attach($status->id);
        $event = $this->mock(VacancyWasDeleted::class);
        $event->vacancy = $vacancy;

        (new NotifyUsersVacancyDeleted())->handle($event);

        Mail::assertSent(SendVacancyRequiresWithdrawingNotification::class, function ($mail) {
            return $mail->hasTo(config('vandango.blink.vacancies.email'));
        });
    }

    /** @test */
    public function it_does_not_send_a_notification_for_a_draft_vacancy()
    {
        Mail::fake();

        $status = factory(Status::class)->states('vacancy', 'draft')->create();

        $vacancy = factory(Vacancy::class)->create();
        $vacancy->statuses()->attach($status->id, ['updated_by' => $vacancy->submitted_by]);

        $event = $this->mock(VacancyWasDeleted::class);
        $event->vacancy = $vacancy;

        (new NotifyUsersVacancyDeleted())->handle($event);

        Mail::assertNotSent(SendVacancyRequiresWithdrawingNotification::class);
    }
}
