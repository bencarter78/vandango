<?php

namespace App\Jobs\Judi;

use App\Judi\Pa;
use App\Jobs\Job;
use App\Judi\Models\User;
use App\Judi\Models\Sector;
use App\Judi\AssessmentDate;
use App\Judi\Models\Assessment;
use App\Judi\Repositories\AssessmentRepository;

class PlanAssessments extends Job
{
    /**
     * @var Sector
     */
    private $user;

    /**
     * @var Sector
     */
    private $sector;

    /**
     * @var Assessment
     */
    private $assessments;

    /**
     * Create a new command instance.
     *
     * @param User   $user
     * @param Sector $sector
     */
    public function __construct(User $user, Sector $sector)
    {
        $this->user = $user;
        $this->sector = $sector;
    }

    /**
     * Handle the command.
     *
     * @param AssessmentRepository $assessments
     * @param Pa                   $pa
     * @param AssessmentDate       $date
     */
    public function handle(AssessmentRepository $assessments, Pa $pa, AssessmentDate $date)
    {
        $this->assessments = $assessments;

        $this->user->assessedProcesses()->each(function ($process) use ($pa, $date) {
            try {
                if ($this->inScope($process)) {
                    $this->assessments->add([
                        'user_id' => $this->user->id,
                        'sector_id' => $this->sector->id,
                        'assessor_id' => $pa->assign($process, $this->sector)->id,
                        'assessment_date' => $date->assign($process, $this->user, $this->sector),
                        'process_id' => $process->id,
                    ]);
                }
            } catch (\Exception $e) {
                dispatch(new SendFailedAssessmentGenerationNotification([
                    'staff' => $this->user,
                    'sector' => $this->sector,
                    'process' => $process,
                    'error' => $e->getMessage(),
                ]));
            }
        });
    }

    /**
     * @param $process
     * @return bool
     */
    private function inScope($process)
    {
        if ($this->userHasAssessment($process) || $this->isOnProbationAndProcessIsExcluded($process)) {
            return false;
        }

        return $this->sector->hasPaDue() || $this->user->isOnProbation();
    }

    /**
     * @param $process
     * @return bool
     */
    private function userHasAssessment($process)
    {
        return $this->assessments->getProcessAssessmentsByUser($process->id, $this->user->id)->count() > 0;
    }

    /**
     * @param $process
     * @return bool
     */
    private function isOnProbationAndProcessIsExcluded($process)
    {
        return $this->user->isOnProbation() && in_array($process->name, config('vandango.judi.processes.excludedForProbation'));
    }
}
