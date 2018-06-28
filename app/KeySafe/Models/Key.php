<?php

namespace App\KeySafe\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Key extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'keysafe_keys';

    /**
     * @var array
     */
    protected $fillable = ['key', 'ident', 'first_name', 'surname', 'email'];
}
