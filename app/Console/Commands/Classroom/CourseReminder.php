<?php

namespace App\Console\Commands\Classroom;

use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Classroom\Models\Timetable;
use App\Mail\Classroom\UpcomingCourseReminder;
use App\Mail\Classroom\TrainerUpcomingCourseReminder;

class CourseReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'classroom:reminder';

    /**
     * @var int
     */
    protected $notice = 7;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder to all attendees due to attend a course in X days time.';

    /**
     * @var static
     */
    protected $date;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->date = Carbon::now()->addDays($this->notice);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $timetable = Timetable::where('starts_at', '>', $this->date->copy()->startOfDay())
                              ->where('starts_at', '<', $this->date->endOfDay())
                              ->get();

        if ($timetable->count() > 0) {
            $timetable->each(function ($t) {
                $t->users->each(function ($user) use ($t) {
                    $this->sendReminder($user, $t);
                });

                $t->guests->each(function ($user) use ($t) {
                    $this->sendReminder($user, $t);
                });

                Mail::to($t->trainer->email)->send(new TrainerUpcomingCourseReminder($t));
            });
        }
    }

    /**
     * @param $user
     * @param $timetable
     */
    private function sendReminder($user, $timetable)
    {
        Mail::to($user->email)->send(new UpcomingCourseReminder($user, $timetable));
    }
}
