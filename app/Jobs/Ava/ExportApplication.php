<?php

namespace App\Jobs\Ava;

use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $application;

    /**
     * @var string
     */
    private $baseDirectory = 'Ava/Applications/';

    /**
     * Create a new job instance.
     *
     * @param $application
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     *
     * @param PDF $pdf
     * @return void
     */
    public function handle(PDF $pdf)
    {
        return Storage::disk(config('vandango.ava.disk'))->put($this->filepath(), $this->html($pdf));
    }

    /**
     * @return string
     */
    private function filepath()
    {
        return implode('', [
            trim($this->baseDirectory),
            '/',
            trim(str_slug("{$this->application->vacancy->organisation->name} {$this->application->vacancy->title} {$this->application->vacancy->ref}")),
            '/',
            trim($this->filename()),
        ]);
    }

    /**
     * @return mixed
     */
    private function filename()
    {
        return implode('', [
            $this->application->applicant->first_name,
            ' ',
            $this->application->applicant->surname,
            ' - AVA000',
            $this->application->id,
            '.pdf',
        ]);
    }

    /**
     * @param PDF $pdf
     * @return string
     */
    private function html(PDF $pdf)
    {
        return $pdf->loadView('ava.applications.show', [
            'about' => json_decode($this->application->about),
            'application' => $this->application,
            'qualifications' => collect($this->application->applicant->qualifications)->filter(function ($v) {
                return $v->vacancy_id == $this->application->vacancy_id;
            }),
            'workHistory' => collect($this->application->applicant->work_history)->filter(function ($h) {
                return $h->vacancy_id === $this->application->vacancy_id;
            }),
        ])->output();
    }
}
