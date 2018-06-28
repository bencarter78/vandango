<?php

namespace App\Console\Commands\Judi;

use App\Judi\Models\Assessment;
use App\Judi\Models\Sector;
use App\Judi\Models\User;
use App\Judi\Pa;
use App\UserManager\Departments\Department;
use Illuminate\Console\Command;

class CheckAssessmentHasValidAssessor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:check-assessor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks to see if an assessment has a valid assessor and assigns one if not';

    /**
     * @var Assessment
     */
    private $assessment;

    /**
     * @var Pa
     */
    private $pa;

    /**
     * Create a new command instance.
     *
     * @param Assessment $assessment
     * @param Pa         $pa
     */
    public function __construct(Assessment $assessment, Pa $pa)
    {
        parent::__construct();
        $this->assessment = $assessment;
        $this->pa = $pa;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->assessment->all()->each(function ($a) {
            if ( ! $this->isValidAssessor(User::find($a->assessor_id))) {
                $this->error('No assessor found for Assessment ID: ' . $a->id);
                if ($user = $this->findPa($a)) {
                    $this->assignUserAsPa($a, $user);
                } else {
                    $this->error("[$a->id]No PA found for {$a->process->name} {$a->sector->title}");
                }
            }
        });
    }

    /**
     * @param $assessor
     * @return bool
     */
    public function isValidAssessor($assessor)
    {
        return $assessor && $assessor->hasRole('Performance Assessor');
    }

    /**
     * @param $assessment
     * @return mixed
     * @throws \App\Exceptions\NoEligiblePaException
     * @throws \Exception
     */
    public function findPa($assessment)
    {
        return $this->pa->assign($assessment->process, $assessment->sector);
    }

    /**
     * @param $a
     * @param $user
     */
    public function assignUserAsPa($a, $user)
    {
        $this->info("Assigning $user->fullName...");
        $a->update(['assessor_id' => $user->id]);
    }
}
