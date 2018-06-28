<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blink_contacts';

    /**
     * @var array
     */
    protected $fillable = ['organisation_id', 'first_name', 'surname', 'email', 'tel', 'job_title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allEnquiries()
    {
        return $this->hasMany(Enquiry::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return ucwords($this->first_name . ' ' . $this->surname);
    }
}
