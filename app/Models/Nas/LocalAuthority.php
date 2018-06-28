<?php

namespace App\Models\Nas;

use Illuminate\Database\Eloquent\Model;

class LocalAuthority extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_local_authorities';

    /**
     * @var array
     */
    protected $fillable = ['county', 'full_name', 'short_name'];
}
