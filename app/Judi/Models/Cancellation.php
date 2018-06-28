<?php

namespace App\Judi\Models;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cancellation extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_cancellations';

    /**
     * @var array
     */
    protected $fillable = ['type'];
}