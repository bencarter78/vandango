<?php

namespace Tests\Feature\Api\V1\Apply;

use App\Events\Apply\StartWasIdentified;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Blink;
use App\Pics\QualificationPlan;
use App\Apply\Models\Applicant;
use App\Eportfolios\Models\Centre;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class ApplicantControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_applicants()
    {
        $applicantA = factory(Applicant::class)->create();
        $applicantB = factory(Applicant::class)->create();
        $applicantC = factory(Applicant::class)->create();

        $response = $this->json('GET', route('api.apply.applicants.index'));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($response->data('data')->contains($applicantA));
        $this->assertTrue($response->data('data')->contains($applicantB));
        $this->assertTrue($response->data('data')->contains($applicantC));
    }

    /** @test */
    public function it_creates_a_new_applicant()
    {
        $user = $this->user();

        $response = $this->json('post', '/api/v1/blink/applicants', [
            'user_id' => $user->id,
            'enquiry_id' => $this->enquiries()->id,
            'adviser_id' => $user->id,
            'email' => 'test@email.com',
            'first_name' => 'Test',
            'surname' => 'McTest',
            'sector_id' => $this->sectors()->id,
            'programme_type' => array_rand(programmeTypes(), 1),
            'qualification_plan_id' => factory(QualificationPlan::class)->create()->id,
            'starting_on' => Carbon::now()->format('d/m/Y'),
            'dob' => Carbon::now()->subYears(17)->format('d/m/Y'),
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_returns_errors_when_required_fields_are_missing()
    {
        $this->json('post', '/api/v1/blink/applicants')
             ->assertStatus(422)
             ->assertJson([
                 "enquiry_id" => ["The enquiry id field is required."],
                 "user_id" => ["The user id field is required."],
                 "first_name" => ["Please enter the first name of the learner."],
                 "surname" => ["Please enter the surname of the learner."],
                 "starting_on" => ["Please enter the proposed start date."],
                 "sector_id" => ["Please select the sector."],
                 "programme_type" => ["Please select the programme type."],
             ]);
    }

    /** @test */
    public function it_updates_an_applicant_slot()
    {
        $qualPlan = factory(QualificationPlan::class)->create();
        $slot = factory(Applicant::class)->create([
            'qualification_plan_id' => null,
            'programme_type' => null,
            'first_name' => null,
            'episode_ident' => null,
            'started_on' => null,
        ]);

        $response = $this->json('PUT', route('api.apply.applicants.update', $slot->id), [
            'first_name' => 'Test',
            'surname' => 'McTest',
            'email' => 'test@email.com',
            'dob' => Carbon::today()->subYears(18)->format('d/m/Y'),
            'starting_on' => $slot->starting_on,
            'sector_id' => $slot->sector_id,
            'qualification_plan_id' => $qualPlan->id,
            'programme_type' => 'Standard',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Test', $slot->fresh()->first_name);
        $this->assertEquals('McTest', $slot->fresh()->surname);
        $this->assertEquals('test@email.com', $slot->fresh()->email);
        $this->assertEquals(Carbon::today()->subYears(18)->format('Y-m-d'), $slot->fresh()->dob->format('Y-m-d'));
        $this->assertTrue($slot->fresh()->qualificationPlan->is($qualPlan));
        $this->assertEquals('Standard', $slot->fresh()->programme_type);
    }

    /** @test */
    public function it_creates_an_eportfolio_record_for_the_applicant_when_the_form_is_created()
    {
        $this->expectsEvents(StartWasIdentified::class);

        $qualPlan = factory(QualificationPlan::class)->create();
        $centre = factory(Centre::class)->create();
        $slot = factory(Applicant::class)->make();

        $response = $this->json('POST', route('api.apply.applicants.store'), [
            'first_name' => 'Test',
            'surname' => 'McTest',
            'email' => 'test@email.com',
            'dob' => Carbon::today()->subYears(18)->format('d/m/Y'),
            'starting_on' => $slot->starting_on->format('d/m/Y'),
            'sector_id' => $slot->sector_id,
            'qualification_plan_id' => $qualPlan->id,
            'programme_type' => 'Standard',
            'centre_id' => $centre->id,
            'user_id' => $slot->user_id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($response->data('data')['applicant']->eportfolio->centre->is($centre));
    }

    /** @test */
    public function it_creates_an_eportfolio_record_for_the_applicant_when_the_form_is_updated()
    {
        $qualPlan = factory(QualificationPlan::class)->create();
        $centre = factory(Centre::class)->create();
        $slot = factory(Applicant::class)->create();

        $response = $this->json('PUT', route('api.apply.applicants.update', $slot->id), [
            'first_name' => 'Test',
            'surname' => 'McTest',
            'email' => 'test@email.com',
            'dob' => Carbon::today()->subYears(18)->format('d/m/Y'),
            'starting_on' => $slot->starting_on,
            'sector_id' => $slot->sector_id,
            'qualification_plan_id' => $qualPlan->id,
            'programme_type' => 'Standard',
            'centre_id' => $centre->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertTrue($slot->fresh()->eportfolio->centre->is($centre));
    }

    /** @test */
    public function it_does_not_register_for_an_eportfolio_record_if_no_centre_is_given()
    {
        $qualPlan = factory(QualificationPlan::class)->create();
        $slot = factory(Applicant::class)->create();

        $response = $this->json('PUT', route('api.apply.applicants.update', $slot->id), [
            'first_name' => 'Test',
            'surname' => 'McTest',
            'email' => 'test@email.com',
            'dob' => Carbon::today()->subYears(18)->format('d/m/Y'),
            'starting_on' => $slot->starting_on,
            'sector_id' => $slot->sector_id,
            'qualification_plan_id' => $qualPlan->id,
            'programme_type' => 'Standard',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertNull($slot->fresh()->eportfolio);
    }
}
