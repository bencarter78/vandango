<?php

namespace App\Apply\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'apply_withdrawals';

    /**
     * @var array
     */
    protected $fillable = ['name'];
}
