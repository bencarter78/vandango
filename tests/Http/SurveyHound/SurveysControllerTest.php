<?php

namespace Tests\Http\SurveyHound;

use Tests\BrowserKitTest;
use App\SurveyHound\Survey;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group surveyhound
 */
class SurveysControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_can_display_all_of_the_surveys()
    {
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit('/surveyhound')
             ->see('All Surveys');
    }

    /** @test */
    function it_displays_the_create_survey_page()
    {
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit('/surveyhound/create')
             ->see('Create Survey');
    }

    /** @test */
    function it_stores_the_survey_on_submit()
    {
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit('/surveyhound/create')
             ->type('Test Title', 'title')
             ->type('Some description', 'description')
             ->type('Some SQL', 'sql')
             ->type('Some Subject', 'subject')
             ->type('Some email message', 'message')
             ->select('day', 'frequency')
             ->press('Create')
             ->seePageIs('/surveyhound')
             ->see('Test Title');
    }

    /** @test */
    function it_can_edit_the_survey()
    {
        $survey = factory(Survey::class)->create();
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit("/surveyhound/{$survey->id}/edit")
             ->see($survey->title);
    }

    /** @test */
    function it_updates_the_survey()
    {
        $survey = factory(Survey::class)->create();
        $date = date('Y-m-d H:i:s');
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit("/surveyhound/{$survey->id}/edit")
             ->type('Some Other Title ' . $date, 'title')
             ->type('Some Other description ' . $date, 'description')
             ->type('Some Other SQL ' . $date, 'sql')
             ->type('Some Other email subject', 'subject')
             ->type('Some Other email message', 'message')
             ->press('Update')
             ->seePageIs('/surveyhound')
             ->see('Some Other Title ' . $date)
             ->see('Some Other description ' . $date);
    }

    /** @test */
    function it_trashes_the_survey()
    {
        $survey = factory(Survey::class)->create();
        $this->actingAs($this->groupUser('surveyHoundAdmin'))
             ->visit('/surveyhound')
             ->see($survey->title)
             ->press('Delete')
             ->seePageIs('/surveyhound')
             ->see('You have successfully trashed the survey');
    }

}