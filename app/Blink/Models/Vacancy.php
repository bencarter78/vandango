<?php

namespace App\Blink\Models;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Nas\Framework;
use App\Apply\Models\Applicant;
use App\Locations\Models\Location;
use App\UserManager\Sectors\Sector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\Blink\VacancyClosingDateWasChanged;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Vacancy extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blink_vacancies';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['closes_on', 'interviews_on', 'starts_on'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applicationManager()
    {
        return $this->belongsTo(User::class, 'application_manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conclusion()
    {
        return $this->belongsTo(Conclusion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function framework()
    {
        return $this->belongsTo(Framework::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hires()
    {
        return $this->belongsToMany(Applicant::class, 'blink_applicant_vacancy')->withPivot('user_id', 'filled_by')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rejected()
    {
        return $this->hasOne(Rejection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'blink_status_vacancy')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * @return bool
     */
    public function isDraft()
    {
        return $this->status()->name == config('vandango.blink.statuses.vacancy-saved');
    }

    /**
     * @return bool
     */
    public function isLive()
    {
        return $this->ref != null
            && $this->closes_on >= Carbon::today()
            && $this->status()->name != config('vandango.blink.statuses.vacancy-rejected');
    }

    /**
     * @return bool
     */
    public function hasClosed()
    {
        // TODO: Work out how to describe a closed vacancy. Also need to introduce 'Archived' vacancies
        return $this->closes_on < Carbon::today()
            && ! $this->isDraft()
            && ! $this->isRejected();
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->attributes['ref'] === null
            && $this->statuses->last()->name == config('vandango.blink.statuses.vacancy-pending');
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return $this->statuses->last()->name == config('vandango.blink.statuses.vacancy-rejected');
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted_at && $this->rejected()->count() === 0;
    }

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->statuses->last();
    }

    /**
     * @param $name
     */
    public function addStatus($name)
    {
        try {
            return $this->statuses()->attach(Status::whereName($name)->first()->id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('No status exists by the name of ' . $name);
        }
    }

    /**
     * @param $date
     */
    public function updateClosingDate($date)
    {
        $original = $this->closes_on->format('Y-m-d');

        $this->closes_on = $date;

        if ($original != $this->closes_on->format('Y-m-d')) {
            $this->closes_on = $date;
            $this->save();
        }

        if ($this->closes_on->format('Y-m-d') > $original) {
            $this->addStatus(config('vandango.blink.statuses.vacancy-live'));
            event(new VacancyClosingDateWasChanged($this));
        }
    }

    /**
     * @param $applicant
     * @param $userId
     * @param $filledByUserId
     */
    public function hire($applicant, $userId, $filledByUserId)
    {
        return $this->hires()->attach($applicant, ['user_id' => $userId, 'filled_by' => $filledByUserId]);
    }

    /**
     * @param $applicant
     * @return bool
     */
    public function hasHired($applicant)
    {
        if ($applicant instanceof Model) {
            return $this->hires->contains($applicant);
        }

        return in_array($applicant, $this->hires()->pluck('id')->all());
    }
}