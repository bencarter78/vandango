<?php

namespace App\Jobs\Eportfolios;

use Onefile\Models\Unit;
use Onefile\Models\Assessor;
use Onefile\Models\Standard;
use Onefile\Models\Classroom;
use Onefile\Models\Placement;
use Onefile\Models\Registrar;
use Illuminate\Bus\Queueable;
use App\Apply\Models\Applicant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Eportfolios\RegistrationFailed;
use App\Events\Eportfolios\AccountWasCreated;
use Onefile\Exceptions\UserNotFoundException;
use Onefile\Exceptions\CentreNotFoundException;

class CreateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Applicant
     */
    private $applicant;

    /**
     * Create a new job instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Execute the job.
     *
     * @param Registrar $registrar
     * @param Assessor  $assessor
     * @param Classroom $classroom
     * @param Placement $placement
     * @param Standard  $standard
     * @param Unit      $unit
     * @return void
     */
    public function handle(
        Registrar $registrar,
        Assessor $assessor,
        Classroom $classroom,
        Placement $placement,
        Standard $standard,
        Unit $unit
    ) {
        try {
            $account = $registrar->registerLearner((object)[
                'FirstName' => $this->applicant->first_name,
                'LastName' => $this->applicant->surname,
                'Email' => $this->applicant->email,
                'OrganisationID' => $this->centreId(),
                'DefaultAssessorID' => $this->assessorId($assessor),
                'ClassroomID' => $this->classroomId($classroom),
                'PlacementID' => $this->placementId($placement),
            ]);

            $this->assignToInduction($standard, $unit, $account);

            $this->applicant->eportfolio->update([
                'ref' => $account->ID,
                'username' => $account->Username,
            ]);

            event(new AccountWasCreated($this->applicant->eportfolio));
        } catch (\Exception $e) {
            Mail::to(config('vandango.eportfolios.email'))->send(new RegistrationFailed($this->applicant, $e));
        }
    }

    /**
     * @return mixed
     */
    private function centreId()
    {
        return $this->applicant->eportfolio->centre->centre_id;
    }

    /**
     * @param $assessor
     * @return mixed
     */
    private function assessorId($assessor)
    {
        return $assessor
            ->setCentreId($this->centreId())
            ->findByNames($this->applicant->adviser->first_name, $this->applicant->adviser->surname)
            ->ID;
    }

    /**
     * @param $classroom
     * @return mixed
     */
    private function classroomId($classroom)
    {
        return $classroom
            ->setCentreId($this->centreId())
            ->findByName(config('vandango.eportfolios.onefile.default-classroom'))
            ->ID;
    }

    /**
     * @param $placement
     * @return mixed
     */
    private function placementId($placement)
    {
        return $placement
            ->setCentreId($this->centreId())
            ->findByName(config('vandango.eportfolios.onefile.default-placement'))
            ->ID;
    }

    /**
     * @param Standard $standard
     * @param Unit     $unit
     * @param          $account
     * @throws \Onefile\Exceptions\NotFoundHttpException
     */
    private function assignToInduction(Standard $standard, Unit $unit, $account)
    {
        $assignedStandard = $this->assignStandard($standard, $account);
        $this->assignUnits($assignedStandard, $unit, $account);
    }

    /**
     * @param Standard $standard
     * @param          $account
     * @return mixed
     * @throws \Onefile\Exceptions\NotFoundHttpException
     */
    private function assignStandard($standard, $account)
    {
        $standardToAssign = $standard
            ->setCentreId($this->centreId())
            ->findById(config('vandango.eportfolios.onefile.induction-id'));

        $standardToAssign->assign($account);

        return $standardToAssign;
    }

    /**
     * @param          $standard
     * @param Unit     $unit
     * @param          $account
     * @throws \Onefile\Exceptions\NotFoundHttpException
     */
    private function assignUnits($standard, $unit, $account)
    {
        foreach ($unit->search(['StandardID' => $standard->ID]) as $inductionUnit) {
            $unitToAssign = $unit->findById($inductionUnit->ID);
            $unitToAssign->assign($standard, $account);
        }
    }
}
