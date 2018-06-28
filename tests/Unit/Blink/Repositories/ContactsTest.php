<?php

namespace Tests\Unit\Blink\Repositories;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Contact;
use App\Blink\Repositories\Contacts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class ContactsTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_contacts_whose_name_matches_a_given_term()
    {
        $this->contacts(1, ['first_name' => 'test', 'surname' => 'mctest']);
        $this->contacts(1, ['first_name' => 'emma', 'surname' => 'mcturtle']);
        $repo = new Contacts(new Contact);
        $this->assertCount(2, $repo->searchByName('mct'));
    }
}