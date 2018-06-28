<?php

namespace App\Notifications\Blink;

use Illuminate\Bus\Queueable;
use App\Apply\Models\Applicant;
use App\Mail\Blink\ApplicantWasAdded;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicantWasAddedToEnquiry extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Applicant
     */
    public $applicant;

    /**
     * Create a new notification instance.
     *
     * @param Applicant $applicant
     */
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return ApplicantWasAdded
     */
    public function toMail($notifiable)
    {
        return (new ApplicantWasAdded($this->applicant))->to($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
