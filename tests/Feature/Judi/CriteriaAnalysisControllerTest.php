<?php

namespace Tests\Feature\Judi;

use Tests\TestCase;
use Tests\Traits\Judi;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class CriteriaAnalysisControllerTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_displays_the_form_to_filter_the_criteria_grades()
    {
        $this->actingAs($this->admin('judi'))
             ->get('/judi/analysis/criteria')
             ->assertStatus(200)
             ->assertSee('Filter');
    }
}
