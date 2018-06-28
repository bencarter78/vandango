<?php

namespace Tests\Unit\UserManager\Sectors;

use Tests\TestCase;
use App\UserManager\Sectors\Sector;
use App\UserManager\Sectors\SectorRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group usermanager
 */
class SectorRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_creates_a_new_sector()
    {
        $repo = new SectorRepository(new Sector());
        $this->assertInstanceOf(Sector::class, $repo->create($this->make(Sector::class)->toArray()));
    }

    /** @test */
    public function it_updates_a_sector()
    {
        $sector = $this->sectors(1, ['name' => 'My Sector Name']);
        $repo = new SectorRepository(new Sector);
        $repo->update($sector->id, ['name' => 'My New Sector Name']);
        $sector = Sector::find($sector->id);
        $this->assertEquals('My New Sector Name', $sector->name);
    }

    /** @test */
    public function it_returns_all_users_belonging_to_a_sector()
    {
        $sector = $this->sectors();
        $this->users(['sectors' => $sector->id], 2);
        $repo = new SectorRepository(new Sector());
        $this->assertEquals(2, $repo->getSectorStaff($sector->id)->users->count());
    }

    /** @test */
    public function it_returns_all_sectors_matching_a_search_term()
    {
        $this->sectors(1, ['name' => 'VanDango']);
        $this->sectors(1, ['code' => 'VAN']);
        $repo = new SectorRepository(new Sector());
        $this->assertEquals(2, $repo->searchByName('van')->count());
        $this->assertInstanceOf(LengthAwarePaginator::class, $repo->searchByName('van', 20));
    }
}