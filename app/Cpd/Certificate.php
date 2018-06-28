<?php

namespace App\Cpd;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    /**
     * @var string
     */
    protected $table = 'cpd_certificates';

    /**
     * @var array
     */
    protected $guarded = [];
}
