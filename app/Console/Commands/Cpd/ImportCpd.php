<?php

namespace App\Console\Commands\Cpd;

use App\Cpd\User;
use Carbon\Carbon;
use App\Cpd\Activity;
use App\Cpd\Organisation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCpd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cpd:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CPD records from the Portal';

    /**
     * @var array
     */
    protected $grades = [
        1 => 4,
        2 => 3,
        3 => 2,
        4 => 1,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::all()->each(function ($user) {
            $activities = DB::connection('portal')
                            ->table('data_users')
                            ->select('cpd_activity.id', 'course_title', 'course_start_date', 'course_expected_end_date', 'course_actual_end_date', 'course_delivered_by', 'course_length')
                            ->where('email', $user->email)
                            ->where('cpd_activity.entry_date', '>=', Carbon::parse('August 2017'))
                            ->join('cpd_activity', 'data_users.id', '=', 'cpd_activity.course_staffID')
                            ->get();

            $activities->each(function ($a) use ($user) {
                try {
                    $reflection = $this->reflection($a->id);

                    Activity::firstOrCreate([
                        'user_id' => $user->id,
                        'title' => $a->course_title,
                        'starts_on' => $a->course_start_date,
                        'ends_on' => $a->course_expected_end_date,
                        'completed_on' => $this->getCompletedDate($a->course_actual_end_date),
                        'total_hours' => $a->course_length,
                        'grade_id' => $reflection ? $this->grades[$reflection->q5] : null,
                        'reflection' => $reflection ? $reflection->comments : null,
                        'deliverer_id' => Organisation::firstOrCreate(['name' => $a->course_delivered_by])->id,
                    ]);
                } catch (\Exception $e) {
                    $this->error("Could not import $a->course_title for $user->fullName");
                    $this->info($e->getMessage() . ' - ' . $e->getCode());
                }
            });
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    private function reflection($id)
    {
        return DB::connection('portal')
                 ->table('cpd_evaluation')
                 ->where('cpd_activity_id', $id)
                 ->first();
    }

    /**
     * @param $date
     * @return null
     */
    private function getCompletedDate($date)
    {
        return $date == '0000-00-00' ? null : $date;
    }
}
