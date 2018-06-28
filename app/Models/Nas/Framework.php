<?php

namespace App\Models\Nas;

use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_frameworks';

    /**
     * @var array
     */
    protected $fillable = ['code', 'full_name', 'short_name', 'occupation_code', 'occupation_full_name', 'occupation_short_name'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->attributes['full_name']} - [{$this->attributes['code']}] {$this->attributes['occupation_full_name']}";
    }
}
