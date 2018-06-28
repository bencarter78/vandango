<?php

namespace App\Classroom\Models;

use App\RoomMate\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'classroom_timetables';

    /**
     * @var array
     */
    protected $fillable = ['course_id', 'room_id', 'trainer_id', 'starts_at', 'ends_at'];

    /**
     * @var array
     */
    protected $dates = ['starts_at', 'ends_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @deprecated
     */
    public function cohort()
    {
        return $this->belongsToMany(User::class, 'classroom_cohorts', 'timetable_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'attendee', 'classroom_cohorts', 'timetable_id')->withPivot('attended', 'cost', 'deleted_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guests()
    {
        return $this->morphedByMany(Guest::class, 'attendee', 'classroom_cohorts')->withPivot('attended', 'cost', 'deleted_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agreements()
    {
        return $this->hasMany(LearningAgreement::class)->withTrashed();
    }

    /**
     * @return mixed
     */
    public function cohortSize()
    {
        return $this->users->count() + $this->guests->count();
    }
}
