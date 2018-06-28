<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\UserManager\Roles\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Blink\VacancyApprovalRequired;

class CheckForUnapprovedVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:vacancies-unapproved';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a notification to ensure the vacancy is approved/rejected';

    /**
     * @var Vacancy
     */
    private $vacancy;

    /**
     * @var Role
     */
    private $role;

    /**
     * @var Status
     */
    private $status;

    /**
     * Create a new command instance.
     *
     * @param Vacancy $vacancy
     * @param Role    $role
     * @param Status  $status
     */
    public function __construct(Vacancy $vacancy, Role $role, Status $status)
    {
        parent::__construct();
        $this->vacancy = $vacancy;
        $this->role = $role;
        $this->status = $status;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->vacancy
            ->all()
            ->filter(function ($v) {
                return $v->statuses->last()->id == $this->getStatus()->id;
            })
            ->each(function ($v) {
                $approver = $this->getApprover($v);

                Mail::to($approver->email)
                    ->cc($v->sector->department->manager->email)
                    ->send(new VacancyApprovalRequired($v, $approver));
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private function getStatus()
    {
        return $this->status->where('name', config('vandango.blink.statuses.vacancy-pending'))->first();
    }

    /**
     * @param $vacancy
     * @return mixed
     */
    private function getApprover($vacancy)
    {
        $users = $this->role
            ->where('job_role', config('vandango.blink.roles.approver'))
            ->first()
            ->users
            ->filter(function ($u) use ($vacancy) {
                return in_array($vacancy->sector_id, $u->sectors->pluck('id')->all());
            });

        if ($users->count() > 0) {
            return $users->random();
        }

        return $vacancy->sector->department->manager;
    }
}
