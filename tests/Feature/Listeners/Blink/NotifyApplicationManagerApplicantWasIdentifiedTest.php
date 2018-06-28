<?php

namespace Tests\Feature\Listeners\Blink;

use App\Events\Apply\StartWasIdentified;
use App\Listeners\Blink\NotifyApplicationManagerApplicantWasIdentified;
use Tests\TestCase;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Blink\ApplicantWasAddedToEnquiry;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotifyApplicationManagerApplicantWasIdentifiedTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_notification_to_the_application_manager_when_an_applicant_has_been_identified()
    {
        Notification::fake();

        $applicant = factory(Applicant::class)->create();
        $vacancy = factory(Vacancy::class)->create(['enquiry_id' => $applicant->enquiry_id]);
        $event = $this->mock(StartWasIdentified::class);
        $event->applicant = $applicant;
        (new NotifyApplicationManagerApplicantWasIdentified())->handle($event);

        Notification::assertSentTo($vacancy->applicationManager, ApplicantWasAddedToEnquiry::class);
    }

    /** @test */
    public function it_does_not_send_a_notification_if_the_application_manager_is_the_account_owner()
    {
        Notification::fake();

        $applicant = factory(Applicant::class)->create();
        $vacancy = factory(Vacancy::class)->create(['enquiry_id' => $applicant->enquiry_id]);
        $vacancy->enquiry->addOwner($vacancy->applicationManager, $userId = 1);
        $event = $this->mock(StartWasIdentified::class);
        $event->applicant = $applicant;
        (new NotifyApplicationManagerApplicantWasIdentified())->handle($event);

        Notification::assertNotSentTo($vacancy->applicationManager, ApplicantWasAddedToEnquiry::class);
    }
}
