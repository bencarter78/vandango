<?php

namespace Tests\Traits;

use App\RoomMate\Models\Room;
use App\RoomMate\Models\Site;
use App\Locations\Models\Location;

trait RoomMate
{
    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function sites($count = 1, $atts = [])
    {
        $sites = $this->create(Site::class, $count, $atts);
        $sites->each(function ($site) {
            $site->location()->save($this->make(Location::class));
        });

        return $sites;
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function rooms($count = 1, $atts = [])
    {
        if (empty($atts)) {
            $atts = ['site_id' => $this->sites()->id];
        }

        return $this->create(Room::class, $count, $atts);
    }
}