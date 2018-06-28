<?php

namespace App\Blink\Models;

use App\Locations\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blink_organisations';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'tel', 'email', 'website', 'twitter', 'datastore_ref',
        'employee_count', 'site_count', 'legal_status', 'levy_pot', 'hq_id', 'edrs',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allEnquiries()
    {
        return $this->hasManyThrough(Enquiry::class, Contact::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->hasManyThrough(Enquiry::class, Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hq()
    {
        return $this->belongsTo(Location::class, 'hq_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function vacancies()
    {
        return $this->hasManyThrough(Vacancy::class, Contact::class);
    }

    /**
     * @param $name
     * @return string
     */
    public function addAliases($name)
    {
        return collect(preg_split('/, ?/', $this->alias))
            ->push($this->name)
            ->filter(function ($alias) use ($name) {
                return $alias != '' && $alias !== $name;
            })
            ->implode(', ');
    }
}
