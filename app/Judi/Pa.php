<?php

namespace App\Judi;

use App\Judi\Models\Sector;
use App\Judi\Models\Process;
use App\Exceptions\NoEligiblePaException;
use App\Judi\Repositories\AssessmentRepository;

class Pa
{
    /**
     * @var Process
     */
    private $process;

    /**
     * @var Sector
     */
    private $sector;

    /**
     * @var
     */
    private $assignedPA;

    /**
     * @var AssessmentRepository
     */
    private $assessments;

    /**
     * Create a new job instance.
     *
     * @param AssessmentRepository $assessments
     */
    public function __construct(AssessmentRepository $assessments)
    {
        $this->assessments = $assessments;
    }

    /**
     * Assigns a Performance Assessor to the planned assessment
     *
     * @param Process $process
     * @param Sector  $sector
     * @return mixed
     * @throws NoEligiblePaException
     * @throws \Exception
     */
    public function assign(Process $process, Sector $sector)
    {
        $this->process = $process;
        $this->sector = $sector;

        return $this->hasPaAssignedToProcess()
            ? $this->assignedPA
            : $this->selectPa();
    }

    /**
     * @return mixed
     */
    public function hasPaAssignedToProcess()
    {
        $assessments = $this->assessments->getProcessAssessmentsBySector($this->getProcessIds(), $this->sector->id);

        if ($this->assessmentHasExistingPa($assessments)) {
            $this->assignedPA = $assessments->first()->assessor;

            return true;
        }
    }

    /**
     * @return mixed
     */
    private function getProcessIds()
    {
        $ids = config('vandango.judi.processes.progressReviewIds');

        return in_array($this->process->id, $ids) ? $ids : $this->process->id;
    }

    /**
     * @param $assessments
     * @return bool
     */
    private function assessmentHasExistingPa($assessments)
    {
        return $assessments->count() > 0
            && $assessments->first()->assessor
            && $this->userIsPa($assessments->first()->assessor);
    }

    /**
     * @return mixed
     * @throws NoEligiblePaException
     * @throws \Exception
     */
    public function selectPa()
    {
        $assessors = $this->getAssessors();

        if ($assessors->count() == 0) {
            throw new NoEligiblePaException("No Performance Assessors were eligible to be assigned to {$this->process->name} for {$this->sector->name}");
        }

        return $assessors[array_rand($assessors->toArray(), 1)];
    }

    /**
     * Returns an array of advisers that are eligible to carry out a given PA process for the given sector
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAssessors()
    {
        $assessors = $this->process->assessors();

        if ($this->sectorCanHaveSameDepartmentAssessor()) {
            return $assessors;
        }

        return $assessors->reject(function ($assessor) {
            return in_array($this->sector->department->id, $assessor->departments->pluck('id')->all());
        });
    }

    /**
     * @return bool
     */
    private function sectorCanHaveSameDepartmentAssessor()
    {
        return $this->sector->department->id == config('vandango.judi.departments.learningDevelopment');
    }

    /**
     * @param $user
     * @return mixed
     */
    private function userIsPa($user)
    {
        return $user->hasRole(config('vandango.judi.roles.pa'));
    }
}
