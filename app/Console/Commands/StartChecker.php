<?php

namespace App\Console\Commands;

use App\Apply\Models\Applicant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class StartChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starts:comparison';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compares PICS starts against VanDango';

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
        if ( ! Cache::has('pics-starts')) {
            Cache::put('pics-starts', Excel::load(storage_path('app/pics-starts.xls'), function ($reader) {
            })->get(), Carbon::now()->addHour());
        }

        $starts = Cache::get('pics-starts')->pluck('ident')->all();

        $applicants = Applicant::wherenotNull('episode_ident')->whereIn('programme_type', ['Standard', 'Framework'])->get();

        $this->line($applicants->count());

        $missing = $applicants->reject(function ($app) use ($starts) {
            return in_array($app->episode_ident, $starts);
        });

        $missing->each(function ($app) {
            $this->line($app->name);
        });

//        dd($missing->count());

        dd($applicants->pluck('episode_ident')->unique()->count());
    }
}
