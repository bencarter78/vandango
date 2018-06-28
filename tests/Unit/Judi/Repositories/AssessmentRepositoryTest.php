<?php

namespace Tests\Unit\Judi\Repositories;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Assessment;
use App\Judi\Repositories\AssessmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group judi
 */
class AssessmentRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_the_next_date_an_assessment_should_take_place_based_on_a_last_assessment_date()
    {
        $model = $this->assessments(1, [
            'assessment_date' => Carbon::createFromFormat('d/m/Y', '17/05/2016'),
        ]);

        $repo = new AssessmentRepository($model);

        $this->assertEquals(
            "2017-05-22",
            $repo->getLastAssessmentDate($model->user, $model->process)
        );
    }

    /** @test */
    public function it_returns_the_date_an_assessment_should_take_place_based_on_the_probation_start_date()
    {
        $process = $this->processes(1, ['trigger_week' => 1]);
        $user = $this->user();
        $user->meta->update(['start_date' => '2017-05-17']);
        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(
            "2017-05-29",
            $repo->getLastAssessmentDate($user, $process)
        );
    }

    /** @test */
    public function it_returns_a_planned_performance_assessment()
    {
        $model = $this->assessments();
        $repo = new AssessmentRepository($model);
        $this->assertEquals(1, $repo->hasPlannedAssessmentDate($model->user->id, $model->process->id)->count());
    }

    /** @test */
    public function it_returns_null_when_no_planned_performance_assessment()
    {
        $model = $this->assessments();
        $repo = new AssessmentRepository($model);
        $this->assertNull($repo->hasPlannedAssessmentDate(5, 5));
    }

    /** @test */
    public function it_returns_a_collection_of_total_assessments_for_a_PA()
    {
        $this->assessments(3, ['assessor_id' => 8]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getCaseload(8)->first()->total);
    }

    /** @test */
    public function it_returns_an_array_of_total_assessments_for_each_PA()
    {
        $this->assessments(3);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getCaseload()->count());
    }

    /** @test */
    public function it_returns_a_PAs_caseload()
    {
        $this->assessments(3, ['assessor_id' => 8]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorCaseload(8)->count());
    }

    /** @test */
    public function it_returns_a_PAs_caseload_with_submitted_and_cancelled_assessments()
    {
        $this->assessments(3, ['assessor_id' => 8])->first()->delete();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorCaseload(8, false, true)->count());
    }

    /** @test */
    public function it_returns_a_PAs_caseload_paginated()
    {
        $this->assessments(3, ['assessor_id' => 8])->first()->delete();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(LengthAwarePaginator::class, $repo->getAssessorCaseload(8, true));
    }

    /** @test */
    public function it_returns_a_PAs_caseload_for_a_given_sector()
    {
        $this->assessments(3, [
            'assessor_id' => 3,
            'sector_id' => 56,
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorCaseloadForSector(3, 56)->count());
    }

    /** @test */
    public function it_returns_a_PAs_caseload_with_submitted_and_cancelled_assessments_for_a_given_sector()
    {
        $assessments = $this->assessments(3, [
            'assessor_id' => 31,
            'sector_id' => 89,
        ]);
        $assessments->first()->delete();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorCaseloadForSector(31, 89, false, true)->count());
    }

    /** @test */
    public function it_returns_a_PAs_caseload_paginated_for_a_given_sector()
    {
        $assessments = $this->assessments(3, [
            'assessor_id' => 47,
            'sector_id' => 64,
        ]);
        $assessments->first()->delete();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getAssessorCaseloadForSector(47, 64, true)
        );
    }

    /** @test */
    public function it_returns_assessors_submitted_assessments()
    {
        $this->assessments(3, ['assessor_id' => 87, 'cancellation_id' => null])
             ->each(function ($a) {
                 $a->delete();
             });

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorSubmittedAssessments(87)->count());
    }

    /** @test */
    public function it_returns_assessors_submitted_assessments_paginated()
    {
        $this->assessments(3, ['assessor_id' => 78, 'cancellation_id' => null])
             ->each(function ($a) {
                 $a->delete();
             });

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getAssessorSubmittedAssessments(78, 10)
        );
    }

    /** @test */
    public function it_returns_all_planned_activity_for_this_month()
    {
        $this->assessments(3, ['assessment_date' => Carbon::now()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getActivityInMonth()->count());
    }

    /** @test */
    public function it_returns_all_planned_activity_for_a_given_month()
    {
        $this->assessments(2, ['assessment_date' => '2017-01-01']);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getActivityInMonth('2017-01')->count());
    }

    /** @test */
    public function it_returns_all_planned_activity_for_this_month_for_a_given_PA()
    {
        $this->assessments(3, [
            'assessment_date' => Carbon::now(),
            'assessor_id' => 8,
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessorActivityInMonth(8)->count());
    }

    /** @test */
    public function it_returns_all_planned_activity_for_a_given_month_for_a_given_PA()
    {
        $this->assessments(2, [
            'assessment_date' => '2017-01-01',
            'assessor_id' => 8,
        ]);
        $this->assessments();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getAssessorActivityInMonth(8, '2017-01')->count());
    }

    /** @test */
    public function it_returns_all_planned_activity_for_a_process_type_for_a_given_future_month()
    {
        $this->assessments(2, [
            'assessment_date' => Carbon::now()->addMonths(2),
            'process_id' => 31,
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getAssessmentTypeInMonth(31, 2)->count());
    }

    /** @test */
    public function it_returns_all_assessments_for_a_sector()
    {
        $this->assessments(2, ['sector_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getSectorAssessments(1, 2)->count());
    }

    /** @test */
    public function it_returns_all_assessments_for_a_sector_paginated()
    {
        $this->assessments(2, ['sector_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getSectorAssessments(1, 10)
        );
    }

    /** @test */
    public function it_returns_all_submitted_assessments_for_a_sector()
    {
        $this->assessments(2, [
            'sector_id' => 1,
            'cancellation_id' => null,
            'deleted_at' => Carbon::now(),
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getSubmittedSectorAssessments(1)->count());
    }

    /** @test */
    public function it_returns_all_submitted_assessments_for_a_sector_paginated()
    {
        $this->assessments(2, [
            'sector_id' => 1,
            'cancellation_id' => null,
            'deleted_at' => Carbon::now(),
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getSubmittedSectorAssessments(1, 10)
        );
    }

    /** @test */
    public function it_returns_all_sector_assessments()
    {
        $this->assessments(2, ['sector_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getAssessmentsBySector(1)->count());
    }

    /** @test */
    public function it_returns_all_sector_assessments_paginated()
    {
        $this->assessments(2, ['sector_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getAssessmentsBySector(1, null, 10)
        );
    }

    /** @test */
    public function it_returns_all_submitted_sector_assessments()
    {
        $this->assessments(2, [
            'sector_id' => 1,
            'cancellation_id' => null,
            'deleted_at' => Carbon::now(),
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getAssessmentsBySector(1, true)->count());
    }

    /** @test */
    public function it_returns_all_submitted_sector_assessments_paginated()
    {
        $this->assessments(2, [
            'sector_id' => 1,
            'cancellation_id' => null,
            'deleted_at' => Carbon::now(),
        ]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getAssessmentsBySector(1, true, 10)
        );
    }

    /** @test */
    public function it_returns_all_user_current_assessments()
    {
        $this->assessments(2, ['user_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getUserAssessments(1)->count());
    }

    /** @test */
    public function it_returns_all_user_current_assessments_paginated()
    {
        $this->assessments(2, ['user_id' => 1]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getUserAssessments(1, 10)
        );
    }

    /** @test */
    public function it_returns_all_user_submitted_assessments()
    {
        $this->assessments(2, ['user_id' => 1, 'cancellation_id' => null, 'deleted_at' => Carbon::now()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->getSubmittedUserAssessments(1)->count());
    }

    /** @test */
    public function it_returns_all_user_submitted_assessments_paginated()
    {
        $this->assessments(2, ['user_id' => 1, 'cancellation_id' => null, 'deleted_at' => Carbon::now()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getSubmittedUserAssessments(1, 10)
        );
    }

    /** @test */
    public function it_updates_the_assessment_record()
    {
        $assessment = $this->assessments(1, ['assessment_date' => '2017-01-01']);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertTrue($repo->update($assessment->id, [
            'assessment_date' => '02/01/2017',
            'assessor_id' => $assessment->assessor_id,
        ]));
    }

    /** @test */
    public function it_creates_a_new_assessment_record()
    {
        $assessment = $this->make(Assessment::class)->toArray();
        $assessment['assessment_date'] = '01/01/2017';
        $assessment['is_reassessment'] = false;

        $repo = new AssessmentRepository(new Assessment());

        $this->assertInstanceOf(Assessment::class, $repo->createManually($assessment));
    }

    /** @test */
    public function it_updates_the_assessment_with_a_cancellation_reason_and_soft_deletes()
    {
        $assessment = $this->assessments();

        $repo = new AssessmentRepository(new Assessment());

        $this->assertTrue($repo->destroy($assessment->id, ['cancellation_id' => 1]));
    }

    /** @test */
    public function it_returns_an_assessors_over_due_reviews()
    {
        $assessments = $this->assessments(3, ['assessor_id' => 1, 'assessment_date' => Carbon::yesterday()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getOverDueAssessments($assessments->first()->assessor_id)->count());
    }

    /** @test */
    public function it_returns_all_pending_assessments_between_now_and_a_future_date()
    {
        $this->assessments(3, ['assessment_date' => Carbon::tomorrow()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessments(5)->count());
    }

    /** @test */
    public function it_returns_all_pending_assessments_between_now_and_a_future_date_for_a_given_assessor()
    {
        $this->assessments(3, ['assessor_id' => 1, 'assessment_date' => Carbon::tomorrow()]);

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(3, $repo->getAssessments(5, 1)->count());
    }

    /** @test */
    public function it_returns_a_collection_of_assessments()
    {
        $this->assessments(2, [
            'deleted_at' => '2017-01-05',
            'sector_id' => 1,
            'process_id' => 1,
        ])->each(function ($assessment) {
            $this->summaries(1, [
                'assessment_id' => $assessment->id,
                'assessment_date' => '2017-01-05 00:00:00',
                'grade_id' => 1,
            ]);
        });

        $this->assessments(3, ['deleted_at' => '2017-01-15'])->each(function ($assessment) {
            $this->summaries(1, [
                'assessment_id' => $assessment->id,
                'assessment_date' => '2017-01-15 00:00:00',
                'grade_id' => 1,
            ]);
        });

        $repo = new AssessmentRepository(new Assessment());

        $this->assertEquals(2, $repo->summary([
            'date_from' => '01/01/2017',
            'date_to' => '08/01/2017',
            'grade_id' => [1],
            'sector_id' => [1],
            'process_id' => [1],
        ])->count());
    }

    /** @test */
    public function it_returns_all_assessments_for_a_given_user_and_process()
    {
        $assessments = $this->assessments(3, ['user_id' => 1, 'process_id' => 4]);
        $uid = $assessments->first()->user_id;
        $pid = $assessments->first()->process_id;
        $repo = new AssessmentRepository(new Assessment());
        $this->assertEquals(3, $repo->getProcessAssessmentsByUser($pid, $uid)->count());
    }

    /** @test */
    public function it_returns_all_assessments_for_a_given_sector_and_process()
    {
        $assessments = $this->assessments(3, ['sector_id' => 1, 'process_id' => 4]);
        $sid = $assessments->first()->sector_id;
        $pid = $assessments->first()->process_id;
        $repo = new AssessmentRepository(new Assessment());
        $this->assertEquals(3, $repo->getProcessAssessmentsBySector($pid, $sid)->count());
    }

    /** @test */
    public function it_returns_all_assessments_for_given_sectors_and_processes()
    {
        $assessments = $this->assessments(3, ['sector_id' => 1, 'process_id' => 4]);
        $sid = $assessments->first()->sector_id;
        $pid = $assessments->first()->process_id;
        $repo = new AssessmentRepository(new Assessment());
        $this->assertEquals(3, $repo->getProcessAssessmentsBySector([$pid], [$sid])->count());
    }

    /** @test */
    public function it_summarises_assessments_by_process()
    {
        $grades = $this->grades(3);

        $assessments = $this->assessments(3, ['process_id' => $this->processes()->id])
                            ->each(function ($a, $key) use ($grades) {
                                $this->summaries(1, ['assessment_id' => $a->id, 'grade_id' => $grades[$key]]);
                            });

        $repo = new AssessmentRepository(new Assessment());
        $summary = $repo->summariseByProcess($assessments, $grades);

        $this->assertEquals(3, count($summary->first()));
        $this->assertEquals(1, $summary->first()[0][$grades->first()->id]);
    }

    /** @test */
    public function it_summarises_assessments_by_grade_totals()
    {
        $grades = $this->grades(3)->each(function ($g) {
            $this->summaries(2, ['grade_id' => $g->id]);
        });

        $repo = new AssessmentRepository(new Assessment());
        $summary = $repo->summariseGradeTotals(Assessment::all(), $grades);

        $this->assertEquals(3, $summary->count());
        $this->assertEquals(2, $summary->first()->count());
    }
}
