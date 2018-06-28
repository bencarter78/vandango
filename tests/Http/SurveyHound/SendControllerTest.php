<?php

namespace Tests\Http\SurveyHound;

use Tests\BrowserKitTest;
use App\SurveyHound\Survey;
use App\Jobs\SurveyHound\SendSurvey;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group surveyhound
 */
class SendControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_dispatches_the_survey_to_be_sent()
    {
        $group = $this->groups(1, ['slug' => 'surveyHoundAdmin']);
        $survey = factory(Survey::class)->create();
        $this->expectsJobs(SendSurvey::class);
        $this->actingAs($this->user(['groups' => $group->id]))
             ->visit("/surveyhound/send/{$survey->id}");
    }
}
