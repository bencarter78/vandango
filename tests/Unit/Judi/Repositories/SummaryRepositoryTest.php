<?php

namespace Tests\Unit\Judi\Repositories;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Summary;
use App\Judi\Repositories\SummaryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group judi
 */
class SummaryRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_delete_a_summary_and_the_associated_assessment()
    {
        $summary = $this->summaries();

        $repo = new SummaryRepository(new Summary());

        $this->assertTrue($repo->delete($summary));
    }

    /** @test */
    public function it_returns_summaries_filtered()
    {
        $this->summaries(5, [
            'grade_id' => 11,
            'assessment_date' => '2017-01-15',
            'assessment_id' => $this->assessments(1, ['sector_id' => 71, 'process_id' => 31])->id,
            'deleted_at' => Carbon::now(),
        ]);

        $this->assessments(3);

        $repo = new SummaryRepository(new Summary());

        $this->assertEquals(5, $repo->filter([
            'date_from' => '01/01/2017',
            'date_to' => '31/01/2017',
            'grade_id' => [11],
            'sector_id' => [71],
            'process_id' => [31],
        ])->count());
    }

    /** @test */
    public function it_returns_summaries_filtered_paginated()
    {
        $this->assessments(1);

        $repo = new SummaryRepository(new Summary());

        $this->assertInstanceOf(LengthAwarePaginator::class, $repo->filter([
            'date_from' => '01/01/2017',
            'date_to' => '31/01/2017',
            'grade_id' => [11],
            'sector_id' => [71],
            'process_id' => [31],
        ], 10));
    }

    /** @test */
    public function it_returns_sub_standard_sector_summaries()
    {
        $this->summaries(5, [
            'grade_id' => 3,
            'assessment_id' => $this->assessments(1, ['sector_id' => 71])->id,
            'deleted_at' => Carbon::now(),
        ]);

        $this->summaries(3, ['grade_id' => 99]);

        $repo = new SummaryRepository(new Summary());

        $sectors = [71];

        $this->assertEquals(5, $repo->getSubStandardSectorSummaries($sectors)->total());
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getSubStandardSectorSummaries($sectors)
        );
    }

    /** @test */
    public function it_returns_sub_standard_sector_summaries_where_the_outcome_is_null()
    {
        $this->summaries(5, [
            'grade_id' => 3,
            'assessment_id' => $this->assessments(1, ['sector_id' => 71])->id,
            'deleted_at' => Carbon::now(),
            'outcome' => null,
        ]);

        $this->summaries(3, ['grade_id' => 99]);

        $repo = new SummaryRepository(new Summary());

        $sectors = [71];

        $this->assertEquals(5, $repo->getSubStandardSectorSummaries($sectors, null)->total());
        $this->assertInstanceOf(
            LengthAwarePaginator::class,
            $repo->getSubStandardSectorSummaries($sectors, null)
        );
    }
}
