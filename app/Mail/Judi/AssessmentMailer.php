<?php
namespace App\Mail\Judi;

use Config;
use TCK\Mailman\Mailman;

class AssessmentMailer extends Mailman
{
    /**
     * @param $recipient
     * @param $sectors
     * @return bool
     */
    public function notifyJudiAdmin($recipient, $sectors)
    {
        $view = 'judi.emails.assessmentGenerated';
        $data['sectors'] = $sectors;
        $subject = 'New Performance Assessments Generated';

        return $this->sendTo($recipient, $subject, $view, $data);
    }

    /**
     * @param $recipient
     * @param $sector
     * @return bool
     */
    public function notifySectorManager($recipient, $sector)
    {
        $view = 'judi.emails.sectorAssessmentsGenerated';
        $subject = 'New Performance Assessments Generated';
        $data['sector'] = $sector;

        return $this->sendTo($recipient, $subject, $view, $data);
    }

    /**
     * @param $recipient
     * @param $user
     * @return bool
     */
    public function userHasCompletedAssessments($recipient, $user)
    {
        $view = 'judi.emails.assessmentCompleted';
        $data['staff'] = $user;
        $subject = 'Performance Assessments Completed';

        return $this->sendTo($recipient, $subject, $view, $data);
    }

    /**
     * @param $assessments
     * @return bool
     */
    public function sendInLearningListRequest($assessments)
    {
        $view = 'judi.emails.inLearningListRequest';
        $data['assessments'] = $assessments;
        $subject = 'Performance Assessment In-Learning List Required';

        return $this->sendTo('programme.admin@totalpeople.co.uk', $subject, $view, $data);
    }

    /**
     * @param $assessment
     * @return bool
     */
    public function sendOverdueAssessmentNotification($assessment)
    {
        $subject = 'Overdue Performance Assessment';
        $view = 'judi.emails.overDueAssessments';
        $data['assessment'] = $assessment;
        $data['cc'] = [$assessment->sector->department->manager->email, Config::get('vandango.judiAdminEmail')];

        return $this->sendTo($assessment->assessor, $subject, $view, $data);
    }

    /**
     * @param $assessments
     * @return bool
     */
    public function sendAssessmentsDueInMonthNotification($assessments)
    {
        $subject = 'Performance Assessments Due This Month';
        $view = 'judi.emails.monthlyAssessmentsDue';
        $data['assessments'] = $assessments;

        return $this->sendTo($assessments->first()->assessor, $subject, $view, $data);
    }

    /**
     * @param $assessment
     * @return bool
     */
    public function sendAssessmentAlmostDueNotification($assessment)
    {
        $subject = 'Performance Assessments Due Soon';
        $view = 'judi.emails.assessmentDue';
        $data['assessment'] = $assessment;
        $data['cc'] = [$assessment->sector->department->manager->email, Config::get('vandango.judiAdminEmail')];

        return $this->sendTo($assessment->assessor, $subject, $view, $data);
    }

    /**
     * @param $assessment
     * @return bool
     */
    public function activityReportAssessorReminder($assessment)
    {
        $subject = 'Performance Assessments Activity Report';
        $view = 'judi.emails.activity-report-reminder';
        $data['assessment'] = $assessment;
        $data['attachment'] = public_path('uploads/judi/activity-report.docx');

        return $this->sendTo($assessment->assessor, $subject, $view, $data);
    }

    /**
     * @param $recipient
     * @return bool
     */
    public function sendUserAssessmentNotification($recipient)
    {
        $view = 'judi.emails.staff-pa-notification';
        $subject = 'Your Upcoming PA Assessments';

        return $this->sendTo($recipient, $subject, $view);
    }

    /**
     * @param $data
     * @return bool
     */
    public function assessmentGenerationFailed($data)
    {
        $view = 'judi.emails.assessment-generation-failed';
        $subject = 'Assessment Generation Has Failed';
        $data['cc'] = Config::get('vandango.superAdminEmail');

        return $this->sendTo('judi@totalpeople.co.uk', $subject, $view, $data);
    }

}