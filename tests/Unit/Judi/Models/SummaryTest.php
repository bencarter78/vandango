<?php

namespace Tests\Unit\Judi\Models;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\UserManager\Users\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class SummaryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_the_manager_for_the_assessed_sector()
    {
        $summary = $this->summaries();

        $this->assertInstanceOf(User::class, $summary->getLineManager());
    }
}
