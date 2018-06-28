<?php

namespace Tests\Unit\Blink\Models;

use Tests\TestCase;
use App\Blink\Models\Contact;

/**
 * @group blink
 */
class ContactTest extends TestCase
{
    /** @test */
    public function it_returns_the_full_name()
    {
        $contact = new Contact(['first_name' => 'test', 'surname' => 'mcTest']);
        $this->assertEquals('Test McTest', $contact->name);
    }
}
