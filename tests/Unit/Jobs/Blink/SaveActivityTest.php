<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Blink\Models\Activity;
use App\Jobs\Blink\SaveActivity;
use Illuminate\Database\Eloquent\Model;

/**
 * @group blink
 */
class SaveActivityTest extends TestCase
{
    /** @test */
    public function it_returns_a_new_enquiry_activity()
    {
        $activity = $this->mock(Activity::class);
        $activity->shouldReceive('create')->once()->andReturnSelf();

        $owner = $this->mock(Model::class);
        $owner->shouldReceive('activities')->once()->andReturn($activity);

        $job = new SaveActivity($owner, ['note' => 'Some amazing note...', 'updated_by' => 1]);
        $this->assertInstanceOf(Activity::class, $job->handle());
    }
}
