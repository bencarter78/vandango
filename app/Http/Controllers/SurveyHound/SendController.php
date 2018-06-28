<?php

namespace App\Http\Controllers\SurveyHound;

use App\Http\Controllers\Controller;
use App\Jobs\SurveyHound\SendSurvey;
use App\SurveyHound\SurveyRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendController extends Controller
{
    use DispatchesJobs;

    /**
     * @var TaskRepository
     */
    private $surveys;

    /**
     * SendController constructor.
     *
     * @param $surveys
     */
    public function __construct(SurveyRepository $surveys)
    {
        $this->surveys = $surveys;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Core\EntityNotFoundException
     */
    public function index($id)
    {
        $this->dispatch(
            new SendSurvey($this->surveys->requireById($id))
        );
        
        return back()->with(
            'success',
            'Your survey has been queued for delivery and should be delivered shortly.'
        );
    }
}
