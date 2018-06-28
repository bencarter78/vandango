<?php

namespace App\Judi\Repositories;

use App\Judi\Models\Report;
use App\Core\BaseRepository;

class ReportRepository extends BaseRepository
{
    /**
     * @var Grade
     */
    protected $model;

    /**
     * @param Report $model
     */
    function __construct(Report $model)
    {
        $this->model = $model;
    }

    /**
     * @param $input
     * @return static
     */
    public function create($input)
    {
        $report = $this->model->create([
            'title' => $input['title'],
            'description' => $input['description'],
        ]);

        $this->syncCriteria($report, $input);

        return $report;
    }

    /**
     * @param $report
     * @param $input
     * @return mixed
     */
    private function syncCriteria($report, $input)
    {
        $report->criteria()->detach();

        if (isset($input['criteria'])) {
            return $report->criteria()->attach($input['criteria']);
        }
    }

    /**
     * @param $id
     * @param $input
     * @return static
     */
    public function update($id, $input)
    {
        $report = $this->model->find($id);

        $report->update([
            'title' => $input['title'],
            'description' => $input['description'],
        ]);

        $this->syncCriteria($report, $input);

        return $report;
    }
}