<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'view'];
}
