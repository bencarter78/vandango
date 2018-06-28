<?php

namespace App\Judi\Repositories;

use Carbon\Carbon;
use App\Core\BaseRepository;
use App\Judi\Models\Criteria;
use Illuminate\Support\Facades\DB;

class CriteriaRepository extends BaseRepository
{
    /**
     * @var Grade
     */
    protected $model;

    /**
     * @param Criteria $model
     */
    function __construct(Criteria $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function summariseCriteriaGrades($data)
    {
        $q = DB::table('judi_criteria_summary')
               ->select(
                   'users.id as user_id', 'users.first_name', 'users.surname',
                   'data_sectors.id as sector_id', 'data_sectors.code', 'data_sectors.name',
                   'judi_summaries.id as summary_id', 'judi_summaries.assessment_date',
                   'judi_processes.name as process_name',
                   'judi_criteria.name as criteria_name',
                   'judi_grades.name as grade_name'
               )
               ->join('judi_summaries', 'judi_criteria_summary.summary_id', '=', 'judi_summaries.id')
               ->join('judi_assessments', 'judi_summaries.assessment_id', '=', 'judi_assessments.id')
               ->join('judi_criteria', 'judi_criteria_summary.criteria_id', '=', 'judi_criteria.id')
               ->join('judi_grades', 'judi_criteria_summary.grade_id', '=', 'judi_grades.id')
               ->join('judi_processes', 'judi_assessments.process_id', '=', 'judi_processes.id')
               ->join('users', 'judi_assessments.user_id', '=', 'users.id')
               ->join('data_sectors', 'judi_assessments.sector_id', '=', 'data_sectors.id')
               ->whereNotNull('judi_summaries.deleted_at');

        if (isset($data['date_from'])) {
            $q->where('judi_summaries.assessment_date', '>=', Carbon::createFromFormat('d/m/Y', $data['date_from']));
        }

        if (isset($data['date_to'])) {
            $q->where('judi_summaries.assessment_date', '<=', Carbon::createFromFormat('d/m/Y', $data['date_to']));
        }

        if (isset($data['grade_id'])) {
            $q->whereIn('judi_criteria_summary.grade_id', $data['grade_id']);
        }

        if (isset($data['process_id'])) {
            $q->whereIn('judi_assessments.process_id', $data['process_id']);
        }

        if (isset($data['criteria_id'])) {
            $q->whereIn('judi_criteria_summary.criteria_id', $data['criteria_id']);
        }

        if (isset($data['sector_id'])) {
            $q->whereIn('judi_assessments.sector_id', $data['sector_id']);
        }

        return $q->get();
    }
}