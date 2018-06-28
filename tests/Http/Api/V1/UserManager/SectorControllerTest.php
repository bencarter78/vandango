<?php

namespace Tests\Http\Api\V1\UserManager;

use Tests\BrowserKitTest;
use App\UserManager\Sectors\Sector;

/**
 * @group usermanager
 */
class SectorControllerTest extends BrowserKitTest
{
    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    function it_returns_the_sectors_as_json()
    {
        $sector = $this->sectors();
        $this->visit('api/v1/usermanager/sectors')->seeJson(['name' => $sector->name]);
    }

    /** @test */
    function it_returns_all_sectors_matching_a_search_parameter()
    {
        $care = factory(Sector::class)->create(['name' => 'Healthcare']);
        $childcare = factory(Sector::class)->create(['name' => 'Childcare']);

        $this->visit('api/v1/usermanager/sectors?sector=care')
             ->seeJson([
                 'name' => $childcare->name,
                 'name' => $care->name,
             ]);
    }
}
