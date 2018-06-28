<?php

namespace App\Apply\Models;

use App\Blink\Models\User;
use App\Blink\Models\Enquiry;
use App\Eportfolios\Models\Eportfolio;
use App\Pics\QualificationPlan;
use App\UserManager\Sectors\Sector;
use App\UserManager\Users\User as BaseUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'apply_applicants';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['dob', 'starting_on', 'started_on', 'received_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adviser()
    {
        return $this->belongsTo(User::class, 'adviser_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eportfolio()
    {
        return $this->hasOne(Eportfolio::class, 'applicant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualificationPlan()
    {
        return $this->belongsTo(QualificationPlan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    /**
     * @deprecated
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    /**
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getSurnameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucwords($value);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['surname'];
    }

    /**
     * @param $value
     * @return string
     */
    public function getContactFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setContactFirstNameAttribute($value)
    {
        $this->attributes['contact_first_name'] = ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getContactSurnameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setContactSurnameAttribute($value)
    {
        $this->attributes['contact_surname'] = ucwords($value);
    }

    /**
     * @return string
     */
    public function getOrganisationAttribute()
    {
        $ref = $this->attributes['pics_organisation_id'] ?: 'New Organisation';

        return "{$this->attributes['organisation_name']} [$ref]";
    }

    /**
     * @return bool
     */
    public function hasStarted()
    {
        return $this->attributes['episode_ident'] != null;
    }

    /**
     * @return bool
     */
    public function hasBeenHired()
    {
        return $this->enquiry->vacancies->filter->hasHired($this)->count() > 0;
    }

    /**
     * @return bool
     */
    public function hasNotBeenHired()
    {
        return ! $this->hasBeenHired();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }

    /**
     * @param $withdrawalId
     * @return bool|null
     * @throws \Exception
     */
    public function withdraw($withdrawalId)
    {
        $this->update(['withdrawal_id' => $withdrawalId]);

        return $this->delete();
    }

    /**
     * @param $user
     * @return bool
     */
    public function assignAdviser($user)
    {
        if ($user instanceof BaseUser || $user instanceof User) {
            $user = $user->id;
        }

        return $this->update(['adviser_id' => $user]);
    }

    /**
     * @return bool
     */
    public function isOnefileRegistered()
    {
        return $this->eportfolio && ! is_null($this->eportfolio->username);
    }

    /**
     * @return bool
     */
    public function canBeOnefileRegistered()
    {
        return ( ! $this->isOnefileRegistered()) && is_null($this->episode_ident);
    }
}
