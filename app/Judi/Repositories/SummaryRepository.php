<?php

namespace App\Judi\Repositories;

use Carbon\Carbon;
use App\Judi\Models\Summary;
use App\Core\BaseRepository;

class SummaryRepository extends BaseRepository
{
    /**
     * @var Summary
     */
    protected $model;

    /**
     * @param Summary $model
     */
    function __construct(Summary $model)
    {
        $this->model = $model;
    }

    /**
     * Soft delete the summary and corresponding assessment.
     *
     * @param $summary
     * @return bool|null
     * @throws \Exception
     */
    public function delete($summary)
    {
        $summary->assessment->delete();

        return $summary->delete();
    }

    /**
     * Filters submitted summaries by date, grade, sector.
     *
     * @param     $data
     * @param int $paginate
     * @return mixed
     */
    public function filter($data, $paginate = null)
    {
        $query = $this->model->onlyTrashed()
                             ->with('assessment', 'grade', 'assessment.sector', 'assessment.process')
                             ->where('assessment_date', '>', Carbon::createFromFormat('d/m/Y', $data['date_from']))
                             ->where('assessment_date', '<', Carbon::createFromFormat('d/m/Y', $data['date_to']))
                             ->whereIn('grade_id', $data['grade_id'])
                             ->whereHas('assessment', function ($q) use ($data) {
                                 $q->whereIn('sector_id', $data['sector_id'])
                                   ->whereIn('process_id', $data['process_id']);
                             })
                             ->orderBy('assessment_date', 'desc');

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    /**
     * Summary of submitted summaries.
     *
     * @param $data
     * @return mixed
     */
    public function summarise($data)
    {
        return $this->filter($data);
    }

    /**
     * @param array     $sectors
     * @param bool|true $pendingOutcomes
     * @param int       $paginate
     * @return mixed
     */
    public function getSubStandardSectorSummaries(array $sectors, $pendingOutcomes = true, $paginate = 20)
    {
        $query = $this->model->with('assessment')
                             ->whereIn('grade_id', [3, 4])
                             ->whereHas('assessment', function ($q) use ($sectors) {
                                 $q->whereIn('sector_id', $sectors);
                             })
                             ->onlyTrashed();

        if ($pendingOutcomes === true) {
            $query->whereNull('outcome');
        }

        return $query->paginate($paginate);
    }
}