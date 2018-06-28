<?php

namespace App\Judi\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_grades';

    /**
     * @var array
     */
    protected $fillable = ['name'];

}