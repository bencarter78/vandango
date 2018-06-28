<?php

namespace Tests\Unit\Jobs\UserManager\Sectors;

use Tests\TestModel;
use App\UserManager\Sectors\Sector;

/**
 * @group usermanager
 */
class SectorTest extends TestModel
{
    /** @test */
    public function it_returns_the_name()
    {
        $sector = new Sector(['name' => 'My Amazing Sector Name']);
        $this->assertEquals('My Amazing Sector Name', $sector->name);
    }
}
