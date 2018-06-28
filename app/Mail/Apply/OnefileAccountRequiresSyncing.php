<?php

namespace App\Mail\Apply;

use App\Apply\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnefileAccountRequiresSyncing extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->applicant->sector->title . ' OneFile Sync Required for IDENT: ' . $this->applicant->episode_ident)
            ->view('emails.apply.applicants.onefile-sync-required');
    }
}
