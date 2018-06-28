<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'url', 'ip', 'user-agent'];
}
