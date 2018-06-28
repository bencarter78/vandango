<?php

namespace App\Events\Judi;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class SectorAssessmentsWerePlanned extends Event
{
    use SerializesModels;
    /**
     * @var Sector
     */
    private $sectors;

    /**
     * Create a new event instance.
     *
     * @param Collection $sectors
     */
    public function __construct(Collection $sectors)
    {
        $this->sectors = $sectors;
    }

    /**
     * @return Sector
     */
    public function getSectors()
    {
        return $this->sectors;
    }

}
