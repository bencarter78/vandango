<?php

namespace App\Models\Nas;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_counties';

    /**
     * @var array
     */
    protected $fillable = ['code', 'name'];
}
