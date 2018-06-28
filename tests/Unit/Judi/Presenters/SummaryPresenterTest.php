<?php

namespace Tests\Unit\Judi\Presenters;

use Tests\TestCase;
use App\Judi\Models\Summary;

/**
 * @group judi
 */
class SummaryPresenterTest extends TestCase
{
    /** @test */
    public function it_displays_an_empty_string_when_no_document_path_is_present()
    {
        $summary = new Summary();
        $summary->document_path = null;
        $this->assertEquals('', $summary->present()->fileName);
    }

    /** @test */
    public function it_displays_the_file_name_for_a_document_path()
    {
        $summary = new Summary();
        $summary->document_path = 'some/path/to/the/filename.txt';
        $this->assertEquals('filename.txt', $summary->present()->fileName);
    }
}
