<?php

namespace App\Jobs\Apply;

use Illuminate\Bus\Queueable;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use App\Mail\Apply\PaperworkIssue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyUserPaperworkHasIssue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Applicant
     */
    private $applicant;

    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param Applicant $applicant
     * @param User      $user
     * @param array     $data
     */
    public function __construct(Applicant $applicant, User $user, array $data = [])
    {
        $this->applicant = $applicant;
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipient = $this->getRecipient();
        Mail::to([$recipient->email, config('vandango.helpdesk.programmeAdmin')])
            ->send(new PaperworkIssue($this->applicant, $this->user, $this->data));
    }

    /**
     * @return mixed
     */
    private function getRecipient()
    {
        return $this->applicant->adviser_id ? $this->applicant->adviser : $this->applicant->submittedBy;
    }
}
