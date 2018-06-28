<?php
namespace App\Jobs\SurveyHound;

use App\Jobs\Job;
use App\SurveyHound\Survey;
use App\Contracts\Datastore;
use App\Services\MessageParser;
use App\SurveyHound\SurveyMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSurvey extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var Survey
     */
    private $survey;

    /**
     * Create a new job instance.
     *
     * @param Survey $survey
     */
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * Execute the job.
     *
     * @param Datastore     $datastore
     * @param SurveyMailer  $mailer
     * @param MessageParser $parser
     */
    public function handle(
        Datastore $datastore,
        SurveyMailer $mailer,
        MessageParser $parser
    ) {
        foreach ($this->results($datastore) as $result) {
            $mailer->sendSurvey($result, [
                'survey' => $this->survey,
                'subject' => $this->survey->subject,
                'content' => $parser->parse($this->survey->message, $result),
            ]);
        }
    }

    /**
     * @param Datastore $datastore
     * @return mixed
     */
    public function results(Datastore $datastore)
    {
        return $datastore->query($this->survey->sql);
    }

}
