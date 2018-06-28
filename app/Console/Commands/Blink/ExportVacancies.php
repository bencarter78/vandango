<?php

namespace App\Console\Commands\Blink;

use App\Blink\Models\Vacancy;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExportVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blink:export-vacancies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all vacancies';

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
        Excel::create('vacancies', function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->fromArray($this->data());
            });
        })->store('csv');
    }

    /**
     * @return mixed
     */
    private function data()
    {
        return Vacancy::withTrashed()
                      ->with('contact.organisation', 'location', 'statuses', 'hires')
                      ->get()
                      ->map(function ($v) {
                          return [
                              'ref' => $v->ref,
                              'title' => $v->title,
                              'organisation' => isset($v->contact) ? $v->contact->organisation->name : null,
                              'town' => isset($v->location) ? $v->location->town : null,
                              'closing_date' => isset($v->closes_on) ? $v->closes_on->format('Y-m-d') : null,
                              'status' => $v->statuses->last()->name,
                              'hires' => $v->hires->map(function ($h) {
                                  return $h->name;
                              })->implode(', '),
                          ];
                      });
    }
}
