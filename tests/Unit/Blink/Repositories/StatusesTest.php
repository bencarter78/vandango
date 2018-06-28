<?php

namespace Tests\Unit\Blink\Repositories;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Blink\Models\Enquiry;
use App\Blink\Repositories\Statuses;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class StatusesTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_the_next_status_for_a_given_entity()
    {
        $unqualified = factory(Status::class)->states('live', 'enquiry')->create(['order' => 1]);
        $qualified = factory(Status::class)->states('live', 'enquiry')->create(['order' => 2]);
        $repository = new Statuses(new Status());

        $this->assertEquals($repository->getNextStatus($unqualified)->id, $qualified->id);
    }

    /** @test */
    public function it_returns_all_statuses_for_a_given_owner_and_type()
    {
        factory(Status::class)->states('live', 'enquiry')->create(['order' => 1]);
        factory(Status::class)->states('live', 'enquiry')->create(['order' => 2]);
        factory(Status::class)->states('completed', 'enquiry')->create(['order' => 3]);
        $repository = new Statuses(new Status());

        $this->assertEquals($repository->getTypeByOwner('live', Enquiry::class)->count(), 2);
    }
}
