<?php
namespace App\Jobs\Judi;

use App\Jobs\Job;
use Illuminate\Http\Request;
use App\Judi\Models\Summary;
use App\Events\Judi\SummaryWasSubmitted;
use App\Exceptions\SummaryIncompleteException;

class SubmitAssessmentSummary extends Job
{
    /**
     * @var Summary
     */
    private $summary;

    /**
     * @var Request
     */
    private $request;

    /**
     * Create a new command instance.
     *
     * @param Summary $summary
     * @param Request $request
     */
    public function __construct(Summary $summary, Request $request)
    {
        $this->summary = $summary;
        $this->request = $request;
    }

    /**
     * Handle the command.
     *
     * @return bool|null
     * @throws SummaryIncompleteException
     */
    public function handle()
    {
        $this->checkForEmptyFields($this->request);
        $this->markComplete($this->summary);
        event(new SummaryWasSubmitted($this->summary->id));

        return $this->summary;
    }

    /**
     * Because the form is dynamic, we want to ensure that no field is left empty
     * so if it has been submitted and it has criteria in the submission
     * then we want to make sure every field has been completed.
     *
     * @param $request
     * @return $this
     * @throws SummaryIncompleteException
     */
    private function checkForEmptyFields($request)
    {
        if ($request->has(['submit', 'criteria'])) {
            foreach ($request->get('criteria') as $key => $value) {
                if ($value == '') {
                    throw new SummaryIncompleteException('Please complete ALL fields before submitting the Process Report Summary');
                }
            }
        }
    }

    /**
     * @param $summary
     * @return $this
     */
    private function markComplete($summary)
    {
        $summary->assessment->delete();
        $summary->delete();
    }
}