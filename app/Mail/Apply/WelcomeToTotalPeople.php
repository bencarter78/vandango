<?php

namespace App\Mail\Apply;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Eportfolios\Models\Eportfolio;
use Illuminate\Queue\SerializesModels;

class WelcomeToTotalPeople extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Eportfolio
     */
    public $eportfolio;

    /**
     * Create a new message instance.
     *
     * @param Eportfolio $eportfolio
     */
    public function __construct(Eportfolio $eportfolio)
    {
        $this->eportfolio = $eportfolio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Welcome To Total People')
            ->view('emails.apply.applicants.welcome-to-total-people');
    }
}
