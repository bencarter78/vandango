<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Blink\Models\Contact;
use App\Jobs\Blink\SaveContact;
use Tck\HumanNameParser\Parser;
use App\Blink\Repositories\Contacts;
use App\Events\Blink\ContactWasAdded;

/**
 * @group blink
 */
class SaveContactTest extends TestCase
{
    public function parser()
    {
        $parser = $this->mock(Parser::class);
        $parser->shouldReceive('setString')->andReturnSelf();
        $parser->shouldReceive('firstName')->once();
        $parser->shouldReceive('surname')->once();

        return $parser;
    }

    /** @test */
    public function it_returns_the_updated_contact_from_a_given_id()
    {
        $repo = $this->mock(Contacts::class);
        $repo->shouldReceive('requireById')->andReturn(new Contact());

        $job = new SaveContact([
            'contact_id' => 1,
            'contact_name' => 'Test McTest',
        ]);
        $this->assertInstanceOf(Contact::class, $job->handle($repo, $this->parser()));
    }

    /** @test */
    public function it_returns_the_new_contact()
    {
        $this->expectsEvents(ContactWasAdded::class);
        $repo = $this->mock(Contacts::class);
        $repo->shouldReceive('add')->andReturn(new Contact());

        $job = new SaveContact(['contact_name' => 'Test McTest']);
        $this->assertInstanceOf(Contact::class, $job->handle($repo, $this->parser()));
    }
}
