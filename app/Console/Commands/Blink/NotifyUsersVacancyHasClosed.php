<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Status;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Blink\Repositories\Vacancies;
use App\Mail\Blink\VacancyHasClosedNotification;

class NotifyUsersVacancyHasClosed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:vacancies-closed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch notifications to vacancies that have closed';

    /**
     * @var Vacancies
     */
    private $vacancies;

    /**
     * Create a new command instance.
     *
     * @param Vacancies $vacancies
     */
    public function __construct(Vacancies $vacancies)
    {
        parent::__construct();
        $this->vacancies = $vacancies;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->vacancies
            ->getClosed()
            ->filter(function ($v) {
                return $v->statuses->last()->id === $this->getLiveStatus()->id;
            })
            ->each(function ($v) {
                Mail::to($this->recipients($v))->send(new VacancyHasClosedNotification($v));
                $this->updateStatus($v);
            });
    }

    /**
     * @return mixed
     */
    private function getLiveStatus()
    {
        return Status::whereName(config('vandango.blink.statuses.vacancy-live'))->first();
    }

    /**
     * @param $v
     * @return \Illuminate\Support\Collection
     */
    public function recipients($v)
    {
        $recipients = collect();

        if ($v->enquiry->owners) {
            $recipients->push($v->enquiry->owners->last()->email);
        }

        if ($v->applicationManager) {
            $recipients->push($v->applicationManager->email);
        }

        return $recipients->unique();
    }

    /**
     * @param $v
     */
    private function updateStatus($v)
    {
        $v->statuses()->attach(
            Status::whereName(config('vandango.blink.statuses.vacancy-closed'))->first()->id
        );
    }
}
