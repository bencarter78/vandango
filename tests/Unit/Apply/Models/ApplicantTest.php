<?php

namespace Tests\Unit\Apply\Models;

use App\Eportfolios\Models\Eportfolio;
use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Vacancy;
use App\UserManager\Users\User;
use App\Apply\Models\Applicant;
use App\Apply\Models\Withdrawal;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class ApplicantTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_withdraws_an_applicant()
    {
        $withdrawal = $this->create(Withdrawal::class);
        $applicant = $this->create(Applicant::class);

        $applicant->withdraw($withdrawal->id);

        $this->assertNotNull($applicant->withdrawal_id);
        $this->assertNotNull($applicant->deleted_at);
    }

    /** @test */
    public function it_assigns_a_user_to_an_applicant_for_a_given_user_id()
    {
        $applicant = $this->create(Applicant::class);
        $adviser = $this->create(User::class);

        $applicant->assignAdviser($adviser->id);

        $this->assertTrue($applicant->adviser->is($adviser));
    }

    /** @test */
    public function it_assigns_a_user_to_an_applicant_for_a_given_user_model()
    {
        $applicant = $this->create(Applicant::class);
        $adviser = $this->create(User::class);

        $applicant->assignAdviser($adviser);

        $this->assertTrue($applicant->adviser->is($adviser));
    }

    /** @test */
    public function it_returns_true_when_an_applicant_has_been_hired_to_an_enquiry_vacancy()
    {
        $vacancy = $this->create(Vacancy::class);
        $applicant = $this->create(Applicant::class, 1, ['enquiry_id' => $vacancy->enquiry_id]);
        $vacancy->hire($applicant, $applicationManager = 123, $filledBy = 456);

        $this->assertTrue($applicant->fresh()->hasBeenHired());
    }

    /** @test */
    public function it_returns_false_when_an_applicant_has_not_been_hired_to_an_enquiry_vacancy()
    {
        $vacancy = $this->create(Vacancy::class);
        $applicant = $this->create(Applicant::class, 1, ['enquiry_id' => $vacancy->enquiry_id]);

        $this->assertFalse($applicant->fresh()->hasBeenHired());
    }

    /** @test */
    public function it_returns_true_if_an_applicant_has_been_registered_for_onefile()
    {
        $applicant = factory(Applicant::class)->create(['episode_ident' => null]);
        $eportfolio = factory(Eportfolio::class)->create(['applicant_id' => $applicant->id]);

        $this->assertTrue($eportfolio->applicant->isOnefileRegistered());
    }

    /** @test */
    public function it_returns_true_if_an_applicant_can_be_registered_for_onefile()
    {
        $applicant = factory(Applicant::class)->create(['episode_ident' => null]);

        $this->assertTrue($applicant->canBeOnefileRegistered());
    }
}
