<?php

namespace App\Judi;

use Carbon\Carbon;
use App\Judi\Models\User;
use App\Judi\Models\Sector;
use App\Judi\Models\Process;

class AssessmentDate
{
    /**
     * Execute the job.
     *
     * @param Process $process
     * @param User    $user
     * @param Sector  $sector
     * @return void
     */
    public function assign(Process $process, User $user, Sector $sector)
    {
        return $user->isOnProbation()
            ? $this->getProbationAssessmentDate($user->meta->start_date, $process->trigger_week)
            : $this->generateAssessmentDate($sector->schedule->month);
    }

    /**
     * @param $date
     * @param $count
     * @return mixed
     */
    public function getProbationAssessmentDate($date, $count)
    {
        return $date->addWeeks($count)->format('Y-m-d');
    }

    /**
     * Creates a proposed date for assessment
     *
     * @param $month
     * @return string
     */
    public function generateAssessmentDate($month)
    {
        $month = Carbon::createFromFormat('n-d', $month . '-01')->startOfDay();
        
        if ($month->month < Carbon::now()->startOfMonth()->format('n')) {
            $month->addYear();
        }

        return $month->endOfMonth()->format('Y-m-d');
    }
}
