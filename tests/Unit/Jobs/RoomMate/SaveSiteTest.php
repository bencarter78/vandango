<?php

namespace Tests\Unit\Jobs\RoomMate;

use Tests\TestCase;
use Tests\Traits\RoomMate;
use App\RoomMate\Models\Site;
use App\Jobs\RoomMate\SaveSite;
use App\Locations\Models\Location;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group roommate
 */
class SaveSiteTest extends TestCase
{
    use DatabaseTransactions, RoomMate;

    protected $site;

    protected $formData = [];

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
        $this->data();
    }

    public function data($data = null)
    {
        $site = $this->make(Site::class);
        $location = $this->make(Location::class);

        $this->formData = $data ? $data : [
            'name' => $site->name,
            'add1' => $location->add1,
            'add2' => $location->add2,
            'add3' => $location->add3,
            'town' => $location->town,
            'county' => $location->county,
            'postcode' => $location->postcode,
            'tel' => $site->tel,
            'is_owned' => "1",
            'has_disabled_access' => "0",
            'opens_at' => '09:45',
            'closes_at' => '12:15',
            'parking' => $site->parking,
        ];
    }

    public function handleJob($site)
    {
        return (new SaveSite($site, $this->formData))->handle();
    }

    /** @test */
    public function it_creates_a_site()
    {
        $site = (new SaveSite(new Site(), $this->formData))->handle();
        $this->assertEquals($site->name, $this->formData['name']);
    }

    /** @test */
    public function it_updates_a_site()
    {
        $site = (new SaveSite($this->sites(), $this->formData))->handle();
        $this->assertEquals($site->opens_at->format('H:i'), $this->formData['opens_at']);
    }

    /** @test */
    public function it_updates_the_site_location()
    {
        $site = $this->sites();
        $this->formData['name'] = $site->name;
        $this->formData['town'] = 'Testville';
        $site = (new SaveSite($site, $this->formData))->handle();
        $this->assertEquals($site->location->town, 'Testville');
    }
}
