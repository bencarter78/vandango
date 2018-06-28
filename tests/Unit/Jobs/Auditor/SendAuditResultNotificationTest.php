<?php
namespace Tests\Unit\Jobs\Auditor;

use Tests\TestCase;
use App\Auditor\Tasks\Task;
use Illuminate\Mail\Mailer;
use App\Services\MessageParser;
use App\Jobs\Auditor\SendAuditResultNotification;
use App\Events\Auditor\TaskRunnerStageWasReached;

/**
 * @group auditor
 */
class SendAuditResultNotificationTest extends TestCase
{
    /** @test */
    function it_sends_the_notifications()
    {
        $this->expectsEvents(TaskRunnerStageWasReached::class);
        $task = $this->mock(Task::class);
        $task->shouldReceive('getAttribute')->with('title')->andReturn("My Awesome Title");
        $task->shouldReceive('getAttribute')->with('recipients')->andReturn('test@test.com, ben@test.com');
        $task->shouldReceive('getAttribute')->with('notification')->andReturn('This is the email content');

        $mailer = $this->mock(Mailer::class);
        $mailer->shouldReceive('to')->andReturn($mailer);
        $mailer->shouldReceive('queue');
        $parser = $this->mock(MessageParser::class);
        $parser->shouldReceive('parse');

        $notifier = new SendAuditResultNotification($task, []);
        $notifier->handle($mailer, $parser);
    }

}
