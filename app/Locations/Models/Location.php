<?php

namespace App\Locations\Models;

use App\Locations\LocationPresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use PresentableTrait, SoftDeletes;

    /**
     * @var
     */
    protected $presenter = LocationPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'add1', 'add2', 'add3', 'town', 'county', 'postcode', 'longitude', 'latitude', 'owner_id', 'owner_type',
    ];

    /**
     * @return mixed
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @param $value
     */
    public function setAdd1Attribute($value)
    {
        $this->attributes['add1'] = ucwords($value);
    }

    /**
     * @param $value
     */
    public function setAdd2Attribute($value)
    {
        $this->attributes['add2'] = ucwords($value);
    }

    /**
     * @param $value
     */
    public function setAdd3Attribute($value)
    {
        $this->attributes['add3'] = ucwords($value);
    }

    /**
     * @param $value
     */
    public function setTownAttribute($value)
    {
        $this->attributes['town'] = ucwords($value);
    }

    /**
     * @param $value
     */
    public function setCountyAttribute($value)
    {
        $this->attributes['county'] = ucwords($value);
    }

    /**
     * @param $value
     */
    public function setPostcodeAttribute($value)
    {
        $this->attributes['postcode'] = strtoupper($value);
    }

    /**
     * @return string
     */
    public function getAddressAttribute()
    {
        return collect([
            $this->attributes['add1'],
            $this->attributes['add2'],
            $this->attributes['add3'],
            $this->attributes['town'],
            $this->attributes['county'],
            $this->attributes['postcode'],
        ])
            ->reject(function ($el) {
                return $el == '' || is_null($el);
            })
            ->implode(', ');
    }
}