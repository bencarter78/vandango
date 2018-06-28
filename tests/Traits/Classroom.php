<?php

namespace Tests\Traits;

use Carbon\Carbon;
use App\Classroom\Models\Timetable;

trait Classroom
{
    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function timetabledCourses($count = 1, $atts = [])
    {
        if (empty($atts)) {
            $date = Carbon::now()->startOfDay();
            $atts = [
                'starts_at' => $date->copy()->addHours(9),
                'ends_at' => $date->copy()->addHours(16),
                'room_id' => $this->rooms()->id,
            ];
        }

        return $this->create(Timetable::class, $count, $atts);
    }
}