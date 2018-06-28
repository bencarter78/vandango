<?php

namespace App\Judi\Repositories;

use Carbon\Carbon;
use App\Core\BaseRepository;
use App\Judi\Models\Assessment;

class AssessmentRepository extends BaseRepository
{
    /**
     * @var Assessment
     */
    protected $model;

    /**
     * @var
     */
    protected $processes;

    /**
     * @param Assessment $model
     */
    function __construct(Assessment $model)
    {
        $this->model = $model;
    }

    /**
     * Returns the date a users last performance assessment was
     *
     * @deprecated
     * This method is crap, it's actually returning the next assessment date
     * based on when there last one was. Needs rewriting
     *
     * @param $user
     * @param $process
     * @return mixed
     */
    public function getLastAssessmentDate($user, $process)
    {
        $assessment = $this->model->where('user_id', $user->id)
                                  ->where('process_id', $process->id)
                                  ->orderBy('assessment_date', 'desc')
                                  ->first();

        if ($assessment) {
            return $assessment->assessment_date->addYear()->next(Carbon::MONDAY)->format('Y-m-d');
        }

        return $user->meta->start_date->addWeeks($process->trigger_week)->next(Carbon::MONDAY)->format('Y-m-d');
    }

    /**
     * Returns a planned performance assessment
     *
     * @param $user
     * @param $process
     * @return mixed
     */
    public function hasPlannedAssessmentDate($user, $process)
    {
        return $this->model->where('user_id', $user)->where('process_id', $process)->first();
    }

    /**
     * Returns the count for a given PA's caseload
     *
     * @param null $assessorId
     * @return mixed
     */
    public function getCaseload($assessorId = null)
    {
        $assessments = $this->model->select('assessor_id', \DB::raw('COUNT(*) as total'))->with(['user', 'assessor']);

        if ($assessorId != null) {
            $assessments->where('assessor_id', $assessorId);
        }

        return $assessments->groupBy('assessor_id')->get();
    }

    /**
     * Get an assessor's caseload
     *
     * @deprecated
     * Should use getPaCaseload
     *
     * @param      $assessorId
     * @param null $paginate
     * @param null $withTrashed
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function getAssessorCaseload($assessorId, $paginate = null, $withTrashed = null)
    {
        return $this->getPaCaseload($assessorId, null, $paginate, $withTrashed);
    }

    /**
     * Get an assessor's caseload for a given sector
     *
     * @deprecated
     * Should use getPaCaseload
     *
     * @param      $assessorId
     * @param      $sectorId
     * @param null $paginate
     * @param null $withTrashed
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function getAssessorCaseloadForSector($assessorId, $sectorId, $paginate = null, $withTrashed = null)
    {
        return $this->getPaCaseload($assessorId, $sectorId, $paginate, $withTrashed);
    }

    /**
     * @param      $assessorId
     * @param null $sectorId
     * @param null $paginate
     * @param null $withTrashed
     * @return mixed
     */
    public function getPaCaseload($assessorId, $sectorId = null, $paginate = null, $withTrashed = null)
    {
        $query = $this->model->where('assessor_id', $assessorId)
                             ->orderBy('assessment_date')
                             ->orderBy('user_id');

        if ($sectorId) {
            $query->where('sector_id', $sectorId);
        }

        if ($withTrashed == true) {
            $query->withTrashed();
        }

        if ($paginate > 0) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    /**
     * Get an assessor's submitted assessments
     *
     * @param      $assessorId
     * @param null $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function getAssessorSubmittedAssessments($assessorId, $paginate = null)
    {
        $query = $this->model->orderBy('deleted_at', 'desc')
                             ->where('assessor_id', $assessorId)
                             ->whereNull('cancellation_id')
                             ->onlyTrashed();

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    /**
     * Returns all planned activity for a given month
     *
     * @deprecated
     * Should use getMonthlyActivity()
     *
     * @param null $month
     * @return mixed
     */
    public function getActivityInMonth($month = null)
    {
        return $this->getMonthlyActivity($month);
    }

    /**
     * Returns all planned activity for a given month
     *
     * @deprecated
     * Should use getMonthlyActivity()
     *
     * @param      $assessorId
     * @param null $month
     * @return mixed
     */
    public function getAssessorActivityInMonth($assessorId, $month = null)
    {
        return $this->getMonthlyActivity($month, $assessorId);
    }

    /**
     * Returns all planned activity for a given month/PA
     *
     * @param null $month
     * @param null $assessorId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMonthlyActivity($month = null, $assessorId = null)
    {
        $month = $month == null ? Carbon::now() : Carbon::createFromFormat('Y-m', $month);

        $assessments = $this->model
            ->with(['user', 'assessor'])
            ->whereBetween('assessment_date', [
                $month->startOfMonth()->format('Y-m-d H:i:s'),
                $month->endOfMonth()->format('Y-m-d H:i:s'),
            ]);

        if ($assessorId !== null) {
            $assessments->where('assessor_id', $assessorId);
        }

        return $assessments->get();
    }

    /**
     * Returns all planned activity for an assessment type between now and a given future month
     *
     * @param $assessmentType Process->id
     * @param $monthOffset integer
     * @return mixed
     */
    public function getAssessmentTypeInMonth($assessmentType, $monthOffset)
    {
        $date = Carbon::now()->firstOfMonth()->addMonths($monthOffset);
        $start = $date->format('Y-m-d H:i:s');
        $end = $date->endOfMonth()->format('Y-m-d H:i:s');

        return $this->model
            ->with(['user', 'assessor'])
            ->where('process_id', $assessmentType)
            ->whereBetween('assessment_date', [$start, $end])
            ->get();
    }

    /**
     * @deprecated
     * Should use getAssessmentsBySector()
     *
     * @param      $sectorId
     * @param null $paginate
     * @return mixed
     */
    public function getSectorAssessments($sectorId, $paginate = null)
    {
        return $this->getAssessmentsBySector($sectorId, null, $paginate);
    }

    /**
     * @deprecated
     * Should use getAssessmentsBySector()
     *
     * @param      $sectorId
     * @param bool $paginate
     * @return mixed
     */
    public function getSubmittedSectorAssessments($sectorId, $paginate = false)
    {
        return $this->getAssessmentsBySector($sectorId, true, $paginate);
    }

    /**
     * @param      $sectorId
     * @param null $submitted
     * @param bool $paginate
     * @return mixed
     */
    public function getAssessmentsBySector($sectorId, $submitted = null, $paginate = null)
    {
        $query = $this->model
            ->with('sector', 'user', 'process', 'assessor', 'summary')
            ->where('sector_id', $sectorId);

        if ($submitted !== null) {
            $query->orderBy('deleted_at', 'desc')
                  ->whereNull('cancellation_id')
                  ->onlyTrashed();
        }

        if ($paginate !== null) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    /**
     * @deprecated
     * Should use getAssessmentsByUser()
     *
     * @param      $userId
     * @param bool $paginate
     * @return mixed
     */
    public function getUserAssessments($userId, $paginate = false)
    {
        return $this->getAssessmentsByUser($userId, null, $paginate);
    }

    /**
     * @deprecated
     * Should use getAssessmentsByUser()
     *
     * @param      $userId
     * @param bool $paginate
     * @return mixed
     */
    public function getSubmittedUserAssessments($userId, $paginate = false)
    {
        return $this->getAssessmentsByUser($userId, true, $paginate);
    }

    /**
     * @param      $userId
     * @param null $submitted
     * @param bool $paginate
     * @return mixed
     */
    public function getAssessmentsByUser($userId, $submitted = null, $paginate = false)
    {
        $query = $this->model->where('user_id', $userId);

        if ($submitted !== null) {
            $query->orderBy('deleted_at', 'desc')
                  ->whereNull('cancellation_id')
                  ->onlyTrashed();
        }

        if ($paginate == false) {
            return $query->get();
        }

        return $query->paginate($paginate);
    }

    /**
     * @param $id
     * @param $input
     * @return bool
     */
    public function update($id, $input)
    {
        return $this->model->find($id)->update([
            'assessor_id' => $input['assessor_id'],
            'assessment_date' => Carbon::createFromFormat('d/m/Y', $input['assessment_date'])->format('Y-m-d'),
        ]);
    }

    /**
     * @param $input
     * @return static
     */
    public function createManually($input)
    {
        return $this->add([
            'user_id' => $input['user_id'],
            'sector_id' => $input['sector_id'],
            'assessor_id' => $input['assessor_id'],
            'process_id' => $input['process_id'],
            'assessment_date' => Carbon::createFromFormat('d/m/Y', $input['assessment_date'])->format('Y-m-d'),
            'is_reassessment' => $input['is_reassessment'],
        ]);
    }

    /**
     * Updates the assessment to give the reason for cancellation and soft deletes.
     *
     * @param $id
     * @param $input
     * @return bool|null
     */
    public function destroy($id, $input)
    {
        $assessment = $this->model->find($id);
        $assessment->update(['cancellation_id' => $input['cancellation_id']]);

        return $assessment->delete();
    }

    /**
     * @deprecated
     * Use getAssessmentsOverDueByAssessor()
     *
     * @param $assessorId
     * @return mixed
     */
    public function getOverDueAssessments($assessorId)
    {
        return $this->getAssessmentsOverDueByAssessor($assessorId);
    }

    /**
     * @param $assessorId
     * @return mixed
     */
    public function getAssessmentsOverDueByAssessor($assessorId)
    {
        return $this->model->where('assessor_id', $assessorId)
                           ->where('assessment_date', '<', Carbon::now()->format('Y-m-d'))
                           ->get();
    }

    /**
     * @param int $days
     * @param     $assessorId
     * @return mixed
     */
    public function getAssessments($days = 0, $assessorId = null)
    {
        $date = Carbon::now();
        $query = $this->model->whereBetween('assessment_date', [
            $date->format('Y-m-d'),
            $date->addDays($days)->format('Y-m-d'),
        ]);

        if ($assessorId) {
            $query->where('assessor_id', $assessorId);
        }

        return $query->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function summary($data)
    {
        return $this->model->onlyTrashed()
                           ->with('summary', 'summary.grade')
                           ->whereHas('summary', function ($q) use ($data) {
                               $q->where('assessment_date', '>', Carbon::createFromFormat('d/m/Y', $data['date_from']))
                                 ->where('assessment_date', '<', Carbon::createFromFormat('d/m/Y', $data['date_to']))
                                 ->whereIn('grade_id', $data['grade_id']);
                           })
                           ->whereIn('sector_id', $data['sector_id'])
                           ->whereIn('process_id', $data['process_id'])
                           ->get();
    }

    /**
     * @param      $pid
     * @param null $withTrashed
     * @return mixed
     */
    public function queryProcessAssessments($pid, $withTrashed = null)
    {
        if (is_int($pid)) {
            $q = $this->model->where('process_id', $pid);
        }

        if (is_array($pid)) {
            $q = $this->model->whereIn('process_id', $pid);
        }

        if ($withTrashed) {
            $q->whereNotNull('deleted_at');
        }

        return $q;
    }

    /**
     * @param $pid
     * @param $uid
     * @return mixed
     */
    public function getProcessAssessmentsByUser($pid, $uid)
    {
        return $this->queryProcessAssessments($pid)->where('user_id', $uid)->get();
    }

    /**
     * @param $pid
     * @param $sid
     * @return mixed
     */
    public function getProcessAssessmentsBySector($pid, $sid)
    {
        return $this->queryProcessAssessments($pid)->where('sector_id', $sid)->get();
    }

    /**
     * @param $assessments
     * @param $grades
     * @return mixed
     */
    public function summariseByProcess($assessments, $grades)
    {
        return $assessments->groupBy('process_id')
                           ->map(function ($process) use ($grades) {
                               return $grades->map(function ($grade) use ($process) {
                                   return [
                                       $grade->id => $process->filter(function ($assessment) use ($grade) {
                                           return $assessment->summary->grade_id == $grade->id;
                                       })->count(),
                                   ];
                               });
                           });
    }

    /**
     * Maps the assessments to a new collection which can be iterated
     * through and counted to determine totals of each grade.
     *
     * @param $assessments
     * @param $grades
     * @return mixed
     */
    public function summariseGradeTotals($assessments, $grades)
    {
        return $grades->map(function ($grade) use ($assessments) {
            return $assessments->filter(function ($assessment) use ($grade) {
                return $assessment->summary->grade_id == $grade->id;
            });
        });
    }
}