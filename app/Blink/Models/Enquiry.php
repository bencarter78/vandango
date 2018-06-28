<?php

namespace App\Blink\Models;

use App\Ignite\Models\Campaign;
use App\Apply\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'blink_enquiries';

    /**
     * @var array
     */
    protected $fillable = [
        'contact_id', 'owner_id', 'referrer_id', 'conclusion_id', 'location', 'employee_count',
        'projected_value', 'actual_value', 'campaign_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivedVacancies()
    {
        return $this->hasMany(Vacancy::class)->onlyTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conclusion()
    {
        return $this->belongsTo(Conclusion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function liveVacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opportunities()
    {
        return $this->hasMany(Opportunity::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owners()
    {
        return $this->belongsToMany(User::class, 'blink_enquiry_user')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function currentOwner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }

    /**
     * @return mixed
     */
    public function owner()
    {
        if ($this->hasOwner()) {
            return $this->owners->last();
        }
    }

    /**
     * @param $user
     * @param $updatedByUserId
     */
    public function addOwner($user, $updatedByUserId)
    {
        $this->update(['owner_id' => $user->id]);

        return $this->owners()->attach($user->id, ['updated_by' => $updatedByUserId]);
    }

    /**
     * @return mixed
     */
    public function hasOwner()
    {
        return $this->owners->count() > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(Referrer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'blink_enquiry_status')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->statuses->last();
    }

    /**
     * @param $status
     * @param $updatedByUserId
     */
    public function addStatus($status, $updatedByUserId)
    {
        return $this->statuses()->attach($status->id, ['updated_by' => $updatedByUserId]);
    }

    /**
     * @param $status
     * @return bool
     */
    public function hasStatus($status)
    {
        if ($this->statuses->count() > 0) {
            return $this->statuses->last()->name === $status;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class)->withTrashed();
    }

    /**
     * @return mixed
     */
    public function unhiredApplicants()
    {
        return $this->applicants->reject->hasBeenHired()->flatten();
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->statuses->last()->name == config('vandango.blink.statuses.completed');
    }
}
