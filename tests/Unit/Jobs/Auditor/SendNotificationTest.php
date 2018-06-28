<?php

namespace Tests\Unit\Jobs\Auditor;

use Carbon\Carbon;
use Tests\TestCase;
use App\Auditor\Tasks\Task;
use Tests\Unit\Jobs\BaseJob;
use App\Auditor\Tasks\TaskMailer;
use App\Jobs\Auditor\SendNotification;

/**
 * @group auditor
 */
class SendNotificationTest extends TestCase
{
    /** @test */
    function it_parses_the_notification_message()
    {
        $notifier = new SendNotification($this->mock(Task::class), []);

        $date = Carbon::now();
        $result = new \stdClass();
        $result->proposed = $date->format('Y-m-d');
        $result->ident = '123456';
        $result->firstname = "Test";
        $result->surname = 'McTest';
        $result->company = 'ABC Ltd';

        $notifier->setMessage('Hello {firstname} {surname} from {company}, the proposed date is {proposed|date:d/m/Y}');
        $notifier->parseMessage($result);
        $this->assertSame('Hello Test McTest from ABC Ltd, the proposed date is ' . $date->format('d/m/Y'), $notifier->getMessage());
    }

    /** @test */
    function it_finds_the_variable_to_convert()
    {
        $notifier = new SendNotification($this->mock(Task::class), []);
        $notifier->setMessage('Hello {firstname} {surname}, today\'s date is {my_date|date:d/m/Y}.');
        $this->assertEquals("{my_date|date:d/m/Y}", $notifier->findVariableFromKey("my_date"));

        $notifier->setMessage('Hello {firstname} {surname}, today\'s date is {my_date}.');
        $this->assertEquals("{my_date}", $notifier->findVariableFromKey("my_date"));
    }

    /** @test */
    function it_formats_the_date_of_a_given_variable_value()
    {
        $notifier = new SendNotification($this->mock(Task::class), []);
        $this->assertEquals(date('d/m/Y'), $notifier->valueFormatter("{my_date|date:d/m/Y}", date('Y-m-d')));
        $this->assertEquals(date('Y-m-d'), $notifier->valueFormatter("{my_date}", date('Y-m-d')));
    }

    /** @test */
    function it_sends_the_notifications()
    {
        $mailer = $this->mock(TaskMailer::class);
        $mailer->shouldReceive('sendTaskNotification')->twice();

        $task = $this->mock(Task::class);
        $task->shouldReceive('getAttribute')->with('title')->andReturn("My Awesome Title");

        $notifier = new SendNotification($task, []);
        $notifier->setRecipients('test@test.com, ben@ben.com');
        $notifier->sendNotification($mailer);
    }

    /** @test */
    function it_sets_the_recipient_dynamically()
    {
        $result = new \stdClass();
        $result->email1 = 'tester@test.com';
        $result->email2 = 'anothertest@test.com';

        $notifier = new SendNotification($this->mock(Task::class), $result);
        $notifier->setRecipients("{email1}, {email2}");

        $this->assertEquals([$result->email1, $result->email2], $notifier->getRecipients());
    }

    /** @test */
    function it_extracts_the_variable_name()
    {
        $notifier = new SendNotification($this->mock(Task::class), []);
        $this->assertEquals('variable', $notifier->extractVariableName("{variable}"));
    }
}
