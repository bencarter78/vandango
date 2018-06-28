<?php

namespace App\Classroom\Repositories;

use Carbon\Carbon;
use App\Core\BaseRepository;
use \App\Classroom\Models\Timetable as TimetableModel;

class Timetable extends BaseRepository
{
    /**
     * @var TimetableModel
     */
    protected $model;

    /**
     * Timetable constructor.
     *
     * @param $model
     */
    public function __construct(TimetableModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $timetableId
     * @param $attendeeId
     * @param $attendeeType
     * @return mixed
     */
    public function getCourseAttendee($timetableId, $attendeeId, $attendeeType)
    {
        return $this->model->where('timetable_id', $timetableId)
                           ->where('attendee_id', $attendeeId)
                           ->where('attendee_type', 'App\\UserManager\\Users\\' . ucfirst($attendeeType))
                           ->first();
    }

    /**
     * @return Illuminate\Support\Collection
     */
    public function getUpcomingCourses()
    {
        return $this->model->with('course', 'trainer', 'venue', 'venue.site', 'venue.site.location')
                           ->where('starts_at', '>=', Carbon::now()->startOfDay())
                           ->orderBy('starts_at')
                           ->get();
    }

    /**
     * @return Illuminate\Support\Collection
     */
    public function getExpiredCourses()
    {
        return $this->model->with('course', 'trainer', 'venue', 'venue.site', 'venue.site.location')
                           ->where('starts_at', '<=', Carbon::now()->startOfDay())
                           ->orderBy('starts_at', 'desc')
                           ->get();
    }
}