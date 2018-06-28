<?php

namespace App\Console\Commands\Judi;

use App\Judi\Models\Summary;
use Illuminate\Console\Command;

class ConvertJudiSummaryCriteriaGrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:convert-grades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extracts all Judi Summary criteria grades to own relationship.';

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
        Summary::withTrashed()->get()->each(function ($s) {
            $s->criteria()->detach();
            foreach (json_decode($s->summary) as $key => $value) {
                try {
                    $s->criteria()->attach([str_replace('criteria_', '', $key) => ['grade_id' => (int)$value->grade]]);
                } catch (\ErrorException $e) {
                    $s->criteria()->attach([str_replace('criteria_', '', $key) => ['grade_id' => (int)$value]]);
                }
            }
        });
    }
}
