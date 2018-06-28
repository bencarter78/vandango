<?php
namespace App\Mail\Judi;

use Config;
use TCK\Mailman\Mailman;

class SummaryMailer extends Mailman
{
    /**
     * @param $recipient
     * @param $summary
     * @return bool
     */
    public function sendOutcomeNotification($recipient, $summary)
    {
        $view = 'judi.emails.summary-outcome';
        $subject = 'Performance Assessment Summary Outcome';
        $data['summary'] = $summary;

        return $this->sendTo($recipient, $subject, $view, $data);
    }

    /**
     * @param $recipient
     * @param $summary
     * @return bool
     */
    public function sendFailedAssessmentNotification($recipient, $summary)
    {
        $view = 'judi.emails.assessment-failed';
        $subject = 'Performance Assessment Summary';
        $data['summary'] = $summary;

        return $this->sendTo($recipient, $subject, $view, $data);
    }

    /**
     * @param $recipient
     * @param $summary
     * @return bool
     */
    public function sendInsufficientEvidenceNotification($recipient, $summary)
    {
        $view = 'judi.emails.insufficient-evidence';
        $subject = 'Insufficient Evidence For Performance Assessment';
        $data['summary'] = $summary;

        return $this->sendTo($recipient, $subject, $view, $data);
    }

}