<?php

namespace App\Judi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'judi_documents';

    /**
     * @var array
     */
    protected $fillable = ['title', 'number', 'url'];
}
