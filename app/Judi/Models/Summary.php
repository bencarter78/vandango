<?php
namespace App\Judi\Models;

use App\Core\BaseModel;
use App\Judi\Presenters\SummaryPresenter;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summary extends BaseModel
{
    use SoftDeletes, PresentableTrait;

    /**
     * @var string
     */
    protected $presenter = SummaryPresenter::class;

    /**
     * @var string
     */
    protected $table = 'judi_summaries';

    /**
     * @var array
     */
    protected $fillable = ['assessment_id', 'report_id', 'grade_id', 'summary', 'assessment_date', 'document_path', 'outcome'];

    /**
     * @var array
     */
    protected $dates = ['assessment_date', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report()
    {
        return $this->belongsTo(Report::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assessment()
    {
        return $this->belongsTo(Assessment::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function criteria()
    {
        return $this->belongsToMany(Criteria::class, 'judi_criteria_summary')->withPivot(['grade_id']);
    }

    /**
     * @return mixed
     */
    public function getLineManager()
    {
        return $this->assessment->sector->department->manager;
    }

}