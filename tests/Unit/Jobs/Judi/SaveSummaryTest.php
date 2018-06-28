<?php

namespace Tests\Unit\Jobs\Judi;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Summary;
use App\Jobs\Judi\SaveSummary;
use App\Jobs\Judi\StoreDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class SaveSummaryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_summary()
    {
        $this->doesntExpectJobs(StoreDocument::class);

        $data = [
            'assessment_id' => 1,
            'report_id' => 1,
            'grade_id' => 1,
            'assessment_date' => '01/01/2017',
            'uploaded_document' => '/path/to/my/file.txt',
            'criteria' => [],
        ];

        $job = new SaveSummary($data);

        $this->assertInstanceOf(Summary::class, $job->handle());
    }

    /** @test */
    public function it_stores_a_linked_document()
    {
        $this->expectsJobs(StoreDocument::class);

        $data = [
            'assessment_id' => 1,
            'report_id' => 1,
            'grade_id' => 1,
            'assessment_date' => '01/01/2017',
            'document_path' => $this->mock(UploadedFile::class),
            'criteria' => [],
        ];

        $job = new SaveSummary($data);

        $this->assertInstanceOf(Summary::class, $job->handle());
    }

    /** @test */
    public function it_updates_a_summary()
    {
        $this->doesntExpectJobs(StoreDocument::class);

        $data = [
            'assessment_id' => 1,
            'report_id' => 1,
            'grade_id' => 1,
            'assessment_date' => '01/01/2017',
            'criteria' => [],
        ];

        $job = new SaveSummary($data);

        $summary = $this->summaries(1, ['assessment_date' => '2017-01-02']);

        $this->assertEquals('2017-01-01', $job->handle($data, $summary)->assessment_date->format('Y-m-d'));
    }

    /** @test */
    public function it_syncs_criteria_grades_from_a_summary()
    {
        $this->doesntExpectJobs(StoreDocument::class);

        $data = [
            'assessment_id' => 1,
            'report_id' => 1,
            'grade_id' => 1,
            'assessment_date' => '01/01/2017',
            'uploaded_document' => '/path/to/my/file.txt',
            'criteria' => [
                $this->criteria(1)->id => 1,
                $this->criteria(1)->id => 1,
                $this->criteria(1)->id => 1,
            ],
        ];

        $job = new SaveSummary($data);

        $summary = $job->handle();

        $this->assertEquals(3, $summary->criteria->count());
    }
}
