<?php

namespace App\Models\Nas;

use Illuminate\Database\Eloquent\Model;

class ErrorCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_error_codes';

    /**
     * @var array
     */
    protected $fillable = ['code', 'description'];
}
