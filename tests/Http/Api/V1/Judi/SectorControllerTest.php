<?php

namespace Tests\Http\Api\V1\Judi;

use Tests\BrowserKitTest;
use App\UserManager\Sectors\Sector;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group judi
 */
class SectorControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_returns_the_sectors_as_json_for_the_admin()
    {
        $sector = $this->sectors();
        $user = $this->groupUser(['judi', 'judiAdmin']);
        $this->actingAs($user)
             ->visit("api/v1/judi/sectors?user={$user->id}")->seeJson([
                'name' => $sector->name,
            ]);
    }

    /** @test */
    function it_returns_a_managers_sectors_as_json_for_the_sector_manager()
    {
        $manager = $this->groupUser(['judi', 'judiSM']);
        $sector = $this->sectors();
        $manager->departments()->attach($sector->department_id);
        $manager->sectors()->attach($sector->id);
        $manager->sectors->first()->update(['department_id' => $manager->departments->first()->id]);
        $sector = $this->sectors();

        $this->actingAs($manager)
             ->visit("api/v1/judi/sectors?user={$manager->id}")
             ->seeJson(['name' => $manager->sectors->first()->name])
             ->dontSeeJson(['name' => $sector->name]);
    }

    /** @test */
    function it_returns_all_sectors_matching_a_search_parameter_for_the_admin()
    {
        $care = factory(Sector::class)->create(['name' => 'Healthcare']);
        $childcare = factory(Sector::class)->create(['name' => 'Childcare']);
        $user = $this->groupUser(['judi', 'judiAdmin']);

        $this->actingAs($user)
             ->visit("api/v1/judi/sectors?user={$user->id}&sector=care")
             ->seeJson([
                 'name' => $childcare->name,
                 'name' => $care->name,
             ]);
    }

}
