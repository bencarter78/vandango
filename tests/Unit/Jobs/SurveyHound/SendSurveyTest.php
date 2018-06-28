<?php

namespace Tests\Unit\Jobs\SurveyHound;

use Tests\TestCase;
use App\SurveyHound\Survey;
use App\Contracts\Datastore;
use App\Services\MessageParser;
use App\SurveyHound\SurveyMailer;
use App\Jobs\SurveyHound\SendSurvey;

/**
 * @group surveyhound
 */
class SendSurveyTest extends TestCase
{
    /** @test */
    function it_queues_the_survey_to_be_sent()
    {
        $survey = $this->mock(Survey::class);
        $survey->shouldReceive('getAttribute')
               ->with('subject')
               ->andReturn('This is the subject title');
        $survey->shouldReceive('getAttribute')
               ->with('message')
               ->andReturn('This is the body of the message');
        $survey->shouldReceive('getAttribute')
               ->with('sql')
               ->andReturn('SQL');

        $results = $this->picsLearner(5);

        $datastore = $this->mock(Datastore::class);
        $datastore->shouldReceive('query')
                  ->with($survey->sql)
                  ->andReturn($results);

        $mailer = $this->mock(SurveyMailer::class);
        $mailer->shouldReceive('sendSurvey')->times(5);

        $parser = $this->mock(MessageParser::class);
        $parser->shouldReceive('parse')->times(5);

        $job = new SendSurvey($survey);
        $job->handle($datastore, $mailer, $parser);
    }
}
