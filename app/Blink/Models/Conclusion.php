<?php

namespace App\Blink\Models;

use Illuminate\Database\Eloquent\Model;

class Conclusion extends Model
{
    /**
     * @var string
     */
    protected $table = 'blink_conclusions';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
