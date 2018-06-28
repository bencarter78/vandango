<?php

namespace App\Models\Nas;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_regions';

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];
}
