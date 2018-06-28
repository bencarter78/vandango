<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_statuses';

    /**
     * @var array
     */
    protected $fillable = ['type', 'name', 'category', 'order'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('name', config('vandango.blink.statuses.pending'))->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnqualified($query)
    {
        return $query->where('name', config('vandango.blink.statuses.unqualified'))->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVacancyLive($query)
    {
        return $query->where('name', config('vandango.blink.statuses.vacancy-live'))->first();
    }
}
