<?php

namespace App\Console\Commands\Pics;

use App\Contracts\HttpClient;
use App\Pics\QualificationPlan;
use Illuminate\Console\Command;
use App\UserManager\Sectors\Sector;

class SyncQualificationPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pics:sync-qual-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the qualification plans from PICS';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->client->get(config('vandango.papi.base') . '/v3/qual-plans');

        foreach ($this->client->getContents()->data as $plan) {
            $site = substr($plan->site, 0, 5);
            $sector = Sector::withTrashed()->where('code', 'LIKE', "$site%")->first();

            if ($sector) {
                QualificationPlan::updateOrCreate(['code' => $plan->plan, 'sector_id' => $sector->id], [
                    'sector_id' => $sector->id,
                    'code' => $plan->plan,
                    'description' => $plan->description,
                    'framework' => $plan->ilr_fwk,
                    'framework_path' => $plan->ilr_fwk_path,
                    'main_aim' => $plan->main_aim,
                    'main_aim_description' => $plan->main_aim_desc,
                ]);
            }
        }
    }
}
