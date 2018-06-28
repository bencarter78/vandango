<?php

namespace App\Judi\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criteria extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_criteria';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];
}