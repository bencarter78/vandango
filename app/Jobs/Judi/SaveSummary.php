<?php

namespace App\Jobs\Judi;

use Carbon\Carbon;
use App\Judi\Models\Summary;

class SaveSummary
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var null
     */
    private $summary;

    /**
     * Create a new job instance.
     *
     * @param array   $data
     * @param Summary $summary
     */
    public function __construct(array $data, $summary = null)
    {
        $this->data = $data;
        $this->summary = $summary ?: new Summary();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->setData();

        $this->summary->offsetExists('id')
            ? $this->summary->update($this->data)
            : $this->summary = $this->summary->create($this->data);

        $this->syncCriteriaGrades();

        return $this->summary;
    }

    /**
     * @return array
     */
    private function setData()
    {
        $this->data = [
            'assessment_id' => $this->data['assessment_id'],
            'report_id' => $this->data['report_id'],
            'grade_id' => $this->data['grade_id'],
            'summary' => isset($this->data['criteria']) ? json_encode($this->data['criteria']) : '',
            'criteria' => isset($this->data['criteria']) ? $this->data['criteria'] : null,
            'document_path' => $this->getDocumentPath($this->data),
            'assessment_date' => isset($this->data['assessment_date'])
                ? $this->getAssessmentDate($this->data['assessment_date'])
                : null,
        ];
    }

    /**
     * @param $data
     * @return mixed|null
     */
    private function getDocumentPath($data)
    {
        if (isset($data['document_path'])) {
            return dispatch(new StoreDocument($data['assessment_id'], $data['document_path']));
        }

        if (isset($data['uploaded_document'])) {
            return $data['uploaded_document'];
        }

        return null;
    }

    /**
     * @param $date
     * @return array
     */
    private function getAssessmentDate($date)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    /**
     * @return void
     */
    private function syncCriteriaGrades()
    {
        if ($this->data['criteria']) {
            $this->summary->criteria()->detach();

            foreach ($this->data['criteria'] as $k => $v) {
                if ($v !== null) {
                    $this->summary->criteria()->attach([$k => ['grade_id' => $v]]);
                }
            }
        }
    }
}
