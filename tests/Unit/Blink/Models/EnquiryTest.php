<?php

namespace Tests\Unit\Blink\Models;

use Tests\TestCase;
use App\Blink\Models\User;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Blink\Models\Enquiry;
use App\Apply\Models\Applicant;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiryTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_true_when_an_enquiry_status_matches_the_given_status_name()
    {
        $status = factory(Status::class)->create();
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addStatus($status, 1);

        $this->assertTrue($enquiry->hasStatus($status->name));
    }

    /** @test */
    public function it_returns_the_status_of_an_enquiry()
    {
        $userId = 1;
        $status = factory(Status::class)->create();
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addStatus($status, $userId);

        $this->assertTrue($status->is($enquiry->status()));
    }

    /** @test */
    public function it_returns_the_owner_of_an_enquiry()
    {
        $user = factory(User::class)->create();
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addOwner($user, $user->id);

        $this->assertTrue($user->is($enquiry->owner()));
    }

    /** @test */
    public function it_returns_true_when_an_enquiry_has_an_owner()
    {
        $user = factory(User::class)->create();
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addOwner($user, $user->id);

        $this->assertTrue($enquiry->hasOwner());
    }

    /** @test */
    public function it_creates_an_activity_for_the_enquiry()
    {
        $user = factory(User::class)->create();
        $enquiry = factory(Enquiry::class)->create();
        $enquiry->addOwner($user, $user->id);

        $this->assertTrue($enquiry->hasOwner());
    }

    /** @test */
    public function it_returns_all_applicants_that_have_not_been_hired()
    {
        $vacancy = $this->create(Vacancy::class);
        $applicantA = $this->create(Applicant::class, 1, ['enquiry_id' => $vacancy->enquiry_id]);
        $applicantB = $this->create(Applicant::class, 1, ['enquiry_id' => $vacancy->enquiry_id]);

        $vacancy->hire($applicantB, $userId = 1, $applicationManager = 123);

        $this->assertTrue($vacancy->enquiry->unhiredApplicants()->first()->is($applicantA));
        $this->assertEquals(1, $vacancy->enquiry->unhiredApplicants()->count());
        $this->assertEquals(2, $vacancy->enquiry->applicants->count());
    }

    /** @test */
    public function it_returns_true_if_an_enquiry_has_been_completed()
    {
        $enquiry = factory(Enquiry::class)->create();
        $status = factory(Status::class)->create(['name' => config('vandango.blink.statuses.completed')]);
        $enquiry->addStatus($status, $userId = 1);

        $this->assertTrue($enquiry->isCompleted());
    }
}
