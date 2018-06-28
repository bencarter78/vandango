<?php

namespace Tests\Unit\Jobs\UserManager\Sectors;

use Tests\TestModel;
use App\UserManager\Sectors\Sector;

/**
 * @group usermanager
 */
class SectorPresenterTest extends TestModel
{
    /** @test */
    public function it_returns_the_name_of_the_sector_with_code()
    {
        $sector = new Sector;
        $sector->code = 'ABC123';
        $sector->name = 'TEST';
        $this->assertEquals('TEST [ABC123]', $sector->present()->sector);
    }

}
