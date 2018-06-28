<?php

namespace App\Mail\Apply;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaperworkIssue extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * @var User
     */
    public $user;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply.applicants.paperwork-issue')
                    ->subject('New Start - Paperwork Issue For ' . ucwords($this->applicant->name));
    }
}
