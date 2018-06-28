<?php

namespace Tests\Unit\Jobs\Eportfolios;

use Tests\TestCase;
use Onefile\Models\Unit;
use Onefile\Models\Learner;
use Onefile\Models\Standard;
use Onefile\Models\Assessor;
use Onefile\Models\Classroom;
use Onefile\Models\Placement;
use Onefile\Models\Registrar;
use App\Apply\Models\Applicant;
use App\Eportfolios\Models\Centre;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Eportfolios\CreateAccount;
use App\Mail\Eportfolios\RegistrationFailed;
use App\Events\Eportfolios\AccountWasCreated;
use Onefile\Exceptions\UserNotFoundException;
use Onefile\Exceptions\NotFoundHttpException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group eportfolio
 */
class CreateAccountTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_onefile_account()
    {
        $this->expectsEvents(AccountWasCreated::class);

        $centre = factory(Centre::class)->create();
        $applicant = factory(Applicant::class)->create();
        $applicant->eportfolio()->create(['centre_id' => $centre->id]);
        $assessor = $this->mock(Assessor::class);
        $assessor->shouldReceive('setCentreId')->once()->andReturnSelf();
        $assessor->shouldReceive('findByNames')->once()->andReturnSelf();
        $classroom = $this->mock(Classroom::class);
        $classroom->shouldReceive('setCentreId')->once()->andReturnSelf();
        $classroom->shouldReceive('findByName')->once()->andReturnSelf();
        $placement = $this->mock(Placement::class);
        $placement->shouldReceive('setCentreId')->once()->andReturnSelf();
        $placement->shouldReceive('findByName')->once()->andReturnSelf();
        $standard = $this->mock(Standard::class);
        $standard->shouldReceive('setCentreId')->once()->andReturnSelf();
        $standard->shouldReceive('findById')->once()->andReturnSelf();
        $standard->shouldReceive('assign')->once()->andReturnSelf();
        $unit = $this->mock(Unit::class);
        $unit->shouldReceive('search')->once()->andReturn([$unit]);
        $unit->shouldReceive('findById')->once()->andReturnSelf();
        $unit->shouldReceive('assign')->once()->andReturnSelf();
        $learner = new Learner(['ID' => 123456, 'Username' => 'TMCTEST']);
        $registrar = $this->mock(Registrar::class);
        $registrar->shouldReceive('registerLearner')->once()->andReturn($learner);

        (new CreateAccount($applicant))
            ->handle($registrar, $assessor, $classroom, $placement, $standard, $unit);

        $this->assertNotNull($applicant->eportfolio->ref);
        $this->assertNotNull($applicant->eportfolio->username);
    }

    /** @test */
    public function it_dispatches_an_email_when_an_assessor_is_not_found()
    {
        Mail::fake();
        $this->doesntExpectEvents(AccountWasCreated::class);

        $centre = factory(Centre::class)->create();
        $applicant = factory(Applicant::class)->create();
        $applicant->eportfolio()->create(['centre_id' => $centre->id]);
        $assessor = $this->mock(Assessor::class);
        $assessor->shouldReceive('setCentreId')->once()->andReturnSelf();
        $assessor->shouldReceive('findByNames')->once()->andThrow(NotFoundHttpException::class);
        $classroom = $this->mock(Classroom::class);
        $placement = $this->mock(Placement::class);
        $standard = $this->mock(Standard::class);
        $unit = $this->mock(Unit::class);
        $registrar = $this->mock(Registrar::class);

        (new CreateAccount($applicant))
            ->handle($registrar, $assessor, $classroom, $placement, $standard, $unit);

        Mail::assertSent(RegistrationFailed::class, function($mail) {
            return $mail->hasTo(config('vandango.eportfolios.email'));
        });
    }
}
