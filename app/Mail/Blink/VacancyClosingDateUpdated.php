<?php

namespace App\Mail\Blink;

use App\Blink\Models\Vacancy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VacancyClosingDateUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Vacancy
     */
    public $vacancy;

    /**
     * Create a new message instance.
     *
     * @param Vacancy $vacancy
     */
    public function __construct(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.blink.vacancy-closing-date-updated');
    }
}
