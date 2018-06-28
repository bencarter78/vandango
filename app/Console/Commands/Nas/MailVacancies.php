<?php

namespace App\Console\Commands\Nas;

use Carbon\Carbon;
use App\Nas\Models\Vacancy;
use Illuminate\Console\Command;
use App\Mail\Nas\TpNasVacancies;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MailVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nas:vacancies-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail vacancies to an email address';

    /**
     * @var Vacancy
     */
    private $vacancy;

    /**
     * @var string
     */
    private $filename;

    /**
     * Create a new command instance.
     *
     * @param Vacancy $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        parent::__construct();
        $this->vacancy = $vacancy;
        $this->filename = 'TP NAS Vacancies - ' . Carbon::now()->format('d-m-Y');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vacancies = $this->vacancy
            ->select(
                'ApprenticeshipFramework',
                'ClosingDate',
                'EmployerName',
                'VacancyAddress',
                'VacancyReference',
                'VacancyTitle',
                'VacancyUrl',
                'WageText',
                'FullDescription'
            )
            ->where('DeliveryOrganisation', 'Total People Ltd')
            ->where('VacancyType', '!=', 'Traineeship')
            ->where('ClosingDate', '>=', Carbon::today())
            ->get();

        Excel::create($this->filename, function ($excel) use ($vacancies) {
            $excel->sheet('vacancies', function ($sheet) use ($vacancies) {
                $sheet->with($vacancies);
            });
        })->store('xlsx');

        Mail::to(config('vandango.nas.mailingList'))
            ->send(new TpNasVacancies('exports/' . $this->filename . '.xlsx'));

        Storage::disk('exports')->delete($this->filename . '.xlsx');
    }
}
