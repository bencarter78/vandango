<?php

namespace App\Cpd;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /**
     * @var string
     */
    protected $table = 'cpd_organisations';

    /**
     * @var array
     */
    protected $guarded = [];
}
