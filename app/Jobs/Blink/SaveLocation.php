<?php

namespace App\Jobs\Blink;

use App\Locations\Models\Location;
use App\Locations\Repositories\Locations;
use App\Exceptions\LocationHasNoOwnerException;

class SaveLocation
{
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job
     *
     * @param Location $model
     * @return Location
     * @throws LocationHasNoOwnerException
     */
    public function handle(Location $model)
    {
        if ($this->hasOwner() && $this->hasAddressElement()) {
            return $model->firstOrCreate([
                'owner_id' => $this->data['location_owner']->id,
                'owner_type' => get_class($this->data['location_owner']),
                'add1' => $this->data['add1'],
                'postcode' => isset($this->data['postcode']) ? $this->data['postcode'] : null,
            ]);
        }
    }

    /**
     * @throws LocationHasNoOwnerException
     * @return bool
     */
    private function hasOwner()
    {
        if (( ! isset($this->data['location_owner'])) || $this->data['location_owner'] == '') {
            throw new LocationHasNoOwnerException('Please assign an owner for this location before saving.');
        }

        return true;
    }

    /**
     * @return bool
     */
    private function hasAddressElement()
    {
        return (isset($this->data['add1']) && $this->data['add1'] != '')
            || (isset($this->data['postcode']) && $this->data['postcode'] != '');
    }
}
