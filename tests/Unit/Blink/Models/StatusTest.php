<?php

namespace Tests\Unit\Blink\Models;

use Tests\TestCase;
use App\Blink\Models\Status;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class StatusTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_the_pending_status()
    {
        $status = factory(Status::class)->create(['name' => config('vandango.blink.statuses.pending')]);

        $this->assertTrue($status->is(Status::pending()));
    }

    /** @test */
    public function it_returns_the_unqualified_status()
    {
        $status = factory(Status::class)->create(['name' => config('vandango.blink.statuses.unqualified')]);

        $this->assertTrue($status->is(Status::unqualified()));
    }

    /** @test */
    public function it_returns_the_live_vacancy_status()
    {
        $status = factory(Status::class)->create(['name' => config('vandango.blink.statuses.vacancy-live')]);

        $this->assertTrue($status->is(Status::vacancyLive()));
    }
}
