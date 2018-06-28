<?php
namespace App\Jobs\Judi;

use App\Jobs\Job;
use App\Mail\Judi\AssessmentMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFailedAssessmentGenerationNotification extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param AssessmentMailer $mailer
     */
    public function handle(AssessmentMailer $mailer)
    {
        $mailer->assessmentGenerationFailed($this->data);
    }
}
