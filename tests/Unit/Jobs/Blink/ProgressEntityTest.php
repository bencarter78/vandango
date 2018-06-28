<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Jobs\Blink\ProgressEntity;
use App\Blink\Repositories\Statuses;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class ProgressEntityTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_attaches_the_next_status_to_an_enquiry()
    {
        $userId = 1;

        $enquiry = $this->enquiries();

        $unqualified = factory(Status::class)->states('live', 'enquiry')->create([
            'name' => config('vandango.blink.statuses.unqualified'),
            'order' => 1,
        ]);

        $qualified = factory(Status::class)->states('live', 'enquiry')->create([
            'name' => config('vandango.blink.statuses.qualified'),
            'order' => 2,
        ]);

        $enquiry->statuses()->attach($unqualified->id, ['updated_by' => 1]);

        $repository = $this->mock(Statuses::class);
        $repository->shouldReceive('getNextStatus')->andReturn($qualified);

        (new ProgressEntity($enquiry, $userId))->handle($repository);

        $this->assertEquals(
            $enquiry->fresh()->statuses->last()->name,
            config('vandango.blink.statuses.qualified')
        );
    }
}
