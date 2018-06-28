<?php

namespace App\Mail\Blink;

use App\Blink\Models\Vacancy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VacancyIsLive extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Vacancy
     */
    public $vacancy;

    /**
     * @var
     */
    public $url;

    /**
     * Create a new message instance.
     *
     * @param Vacancy $vacancy
     * @param         $url
     */
    public function __construct(Vacancy $vacancy, $url)
    {
        $this->vacancy = $vacancy;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('vandango.blink.vacancies.email'))
                    ->subject('Your Vacancy Is Now Live')
                    ->view('emails.blink.vacancy-live');
    }
}
