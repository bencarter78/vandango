<?php

namespace Tests\Unit\Console\Commands\Mailbox;

use Tests\TestCase;
use Illuminate\Mail\Mailer;
use App\Contracts\Mail\Events;
use App\Console\Commands\Mailbox\Bounced;

/**
 * @group mailbox
 */
class BouncedTest extends TestCase
{
    /** @test */
    function it_sends_an_email_to_the_sender_when_an_email_bounces()
    {
        $mailEvents = $this->mock(Events::class);
        $mailEvents->shouldReceive('begin->end->hardBounces->tags->limit->get')->andReturn(collect(range(1, 5)));

        $mailer = $this->mock(Mailer::class);
        $mailer->shouldReceive('to->queue')->times(10);

        $command = new Bounced($mailEvents, $mailer);
        $command->setApps([
            'app' => 'someemail@email.com',
            'some_other_app' => 'someemail@email.com',
        ]);
        $command->handle();
    }
}
