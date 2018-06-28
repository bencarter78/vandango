<?php

namespace App\Blink\Models;

use App\UserManager\Sectors\Sector as BaseSector;

class Sector extends BaseSector
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    /**
     * @return mixed
     */
    public function vacanciesAll()
    {
        return $this->hasMany(Vacancy::class)->withTrashed();
    }

    /**
     * @return mixed
     */
    public function vacanciesLive()
    {
        return $this->vacancies->filter->isLive();
    }

    /**
     * @return mixed
     */
    public function vacanciesClosed()
    {
        return $this->vacanciesAll->filter->hasClosed();
    }

    /**
     * @return mixed
     */
    public function totalHired()
    {
        return $this->vacanciesClosed()->reduce(function ($carry, $vacancy) {
            return $carry + $vacancy->hires->count();
        }, 0);
    }

    /**
     * @return string
     */
    public function vacancyConversionRate()
    {
        $total = $this->vacanciesClosed()->reduce(function ($carry, $vacancy) {
            return $carry + $vacancy->positions_count;
        }, 0);

        $hired = $this->totalHired();

        if ($hired > 0) {
            return number_format($hired / $total * 100);
        }

        return 0;
    }
}
