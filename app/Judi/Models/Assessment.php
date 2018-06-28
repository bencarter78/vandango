<?php
namespace App\Judi\Models;

use App\Core\BaseModel;
use Laracasts\Presenter\PresentableTrait;
use App\Judi\Presenters\AssessmentPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends BaseModel
{
    use SoftDeletes, PresentableTrait;

    /**
     * @var string
     */
    protected $presenter = AssessmentPresenter::class;

    /**
     * @var string
     */
    protected $table = 'judi_assessments';

    /**
     * @var array
     */
    protected $dates = ['assessment_date', 'deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'assessor_id', 'assessment_date', 'process_id', 'sector_id', 'cancellation_id', 'is_reassessment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function summary()
    {
        return $this->hasOne(Summary::class)->withTrashed();
    }

    /**
     * @return bool
     */
    public function hasSummary()
    {
        return $this->summary != null;
    }

    /**
     * @return bool
     */
    public function isSubmitted()
    {
        return $this->attributes['deleted_at'] != null;
    }

    /**
     * @return bool
     */
    public function isPlanned()
    {
        return $this->attributes['deleted_at'] == null;
    }

    /**
     * @param $userId
     * @return string
     */
    public function lastDesktopReview($userId)
    {
        $assessments = $this->where('process_id', 3)
                            ->where('user_id', $userId)
                            ->whereNull('cancellation_id')
                            ->onlyTrashed()
                            ->get();

        if ($assessments->count() > 0) {
            return 'Last Grade: ' . $assessments->last()->summary->grade->name . ' (' . $assessments->last()->assessment_date->format('d/m/Y') . ')';
        }
    }

    /**
     * @param $userId
     * @return string
     */
    public function lastObservationReview($userId)
    {
        $assessments = $this->where('process_id', 10)
                            ->where('user_id', $userId)
                            ->whereNull('cancellation_id')
                            ->whereHas('summary', function ($q) {
                                $q->whereNotNull('deleted_at');
                            })
                            ->onlyTrashed()
                            ->get();

        if ($assessments->count() > 0) {
            return 'Last Grade: ' . $assessments->last()->summary->grade->name . ' (' . $assessments->last()->assessment_date->format('d/m/Y') . ')';
        }
    }

    /**
     * Returns the last grade for a given user for a given assessment
     *
     * @param $userId
     * @param $processId
     * @return string
     */
    public function lastGrade($userId, $processId)
    {
        $assessments = $this->where('process_id', $processId)
                            ->where('user_id', $userId)
                            ->whereNull('cancellation_id')
                            ->whereHas('summary', function ($q) {
                                $q->whereNotNull('deleted_at');
                            })
                            ->onlyTrashed()
                            ->get();

        if ($assessments->count() > 0 && $assessments->last()->summary->deleted_at) {
            return "{$assessments->last()->summary->grade->name} ({$assessments->last()->summary->assessment_date->format('d/m/Y')})";
        }
    }

}