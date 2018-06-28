<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_referrers';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
