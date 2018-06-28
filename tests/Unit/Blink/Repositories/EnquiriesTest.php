<?php

namespace Tests\Unit\Blink\Repositories;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Enquiry;
use App\Blink\Repositories\Enquiries;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiriesTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_unassigned_enquiries()
    {
        $enquiries = $this->enquiries(2);
        $enquiries->first()->owners()->attach($this->user()->id, ['updated_by' => 1]);
        $repository = new Enquiries(new Enquiry());
        $this->assertCount(1, $repository->getUnassigned());
    }
}
