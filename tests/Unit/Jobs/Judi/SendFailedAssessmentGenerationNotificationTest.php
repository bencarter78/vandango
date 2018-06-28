<?php

namespace Tests\Unit\Jobs\Judi;

use Tests\TestCase;
use App\Mail\Judi\AssessmentMailer;
use App\Jobs\Judi\SendFailedAssessmentGenerationNotification;

/**
 * @group judi
 */
class SendFailedAssessmentGenerationNotificationTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification()
    {
        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldReceive('assessmentGenerationFailed')->once();

        $job = new SendFailedAssessmentGenerationNotification([]);
        $job->handle($mailer);
    }
}
