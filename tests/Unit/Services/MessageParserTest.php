<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\MessageParser;

/**
 * @group messageparser
 */
class MessageParserTest extends TestCase
{
    /** @test */
    function it_parses_the_notification_message()
    {
        $parser = new MessageParser();
        $parser->parse(
            "Hello {firstname} {surname}, the proposed date is {proposed|date:d/m/Y}",
            [
                'firstname' => 'Test',
                'surname' => 'McTest',
                'proposed' => date('Y-m-d'),
            ]
        );
        $this->assertSame('Hello Test McTest, the proposed date is ' . date('d/m/Y'), $parser->getMessage());
    }

    /** @test */
    function it_converts_a_date_from_one_format_to_another()
    {
        $parser = new MessageParser();
        $this->assertSame(date('d/m/Y'), $parser->parse("{proposed|date:d/m/Y}", ['proposed' => date('Y-m-d')]));
    }

    /** @test */
    function it_finds_the_variable_to_convert()
    {
        $parser = new MessageParser();
        $parser->setMessage("Hello {firstname} {surname}, today's date is {my_date}.");
        $this->assertEquals("{my_date}", $parser->findTemplateTagFromKey("my_date", $parser->getMessage()));
    }

    /** @test */
    function it_does_not_convert_variable_names_not_in_braces()
    {
        $parser = new MessageParser();
        $parser->parse("My company is called {company}.", ['company' => 'ABC Offshore Ltd']);
        $this->assertSame('My company is called ABC Offshore Ltd.', $parser->getMessage());
    }

    /** @test */
    function it_finds_the_variable_to_convert_with_a_value_formatter()
    {
        $parser = new MessageParser();
        $parser->setMessage("Hello {firstname} {surname}, today's date is {my_date|date:d/m/Y}.");
        $this->assertEquals("{my_date|date:d/m/Y}", $parser->findTemplateTagFromKey("my_date", $parser->getMessage()));
    }

    /** @test */
    function it_formats_the_date_of_a_given_variable_value()
    {
        $parser = new MessageParser();
        $this->assertEquals(date('d/m/Y'), $parser->valueFormatter("{my_date|date:d/m/Y}", date('Y-m-d')));
        $this->assertEquals(date('Y-m-d'), $parser->valueFormatter("{my_date}", date('Y-m-d')));
    }

    /** @test */
    function it_extracts_the_variable_name()
    {
        $parser = new MessageParser();

        $this->assertEquals('variable', $parser->extract("{variable}"));
    }

    /** @test */
    function it_loops_through_content_and_duplicates_the_template()
    {
        $parser = new MessageParser();
        $msg = "
            <p>Hi {vacancy_manger}</p>
            <p>PICS shows that you are the vacancy manager for the following vacancy which closed over 30 days ago:</p>
            <p>@loop</p>
            <ul>
            <li><strong>Title:</strong> {vacancy_title}</li>
            <li><strong>Employer:</strong> {employer_name}</li>
            <li><strong>Closing Date:</strong> {closing_date|date:d/m/Y}</li>
            </ul>
            <p>@endloop</p>
        ";

        $data = json_encode([
            [
                "vacancy_title" => "Apprentice Nursery Nurse at Bluebells Day Nursery                                                                                                     ",
                "status" => "O",
                "closing_date" => "2016-07-18",
                "ref" => "864771                        ",
                "employer_name" => "Just Childcare Limited                                      ",
                "vacancy_manger" => "Maisie                        ",
                "vacancy_manager_email" => "maisie.farrar@totalpeople.co.uk                                                                     ",
            ],
            [
                "vacancy_title" => "Apprentice Nursery Nurse at Cherubs Day Nursery                                                                                                       ",
                "status" => "O",
                "closing_date" => "2016-07-08",
                "ref" => "864774                        ",
                "employer_name" => "Just Childcare Limited                                      ",
                "vacancy_manger" => "Maisie                        ",
                "vacancy_manager_email" => "maisie.farrar@totalpeople.co.uk                                                                     ",
            ],
            [
                "vacancy_title" => "Apprentice Nursery Nurse at Little Stars Private Day Nursery                                                                                          ",
                "status" => "O",
                "closing_date" => "2016-07-18",
                "ref" => "864778                        ",
                "employer_name" => "Just Childcare Limited                                      ",
                "vacancy_manger" => "Maisie                        ",
                "vacancy_manager_email" => "maisie.farrar@totalpeople.co.uk                                                                     ",
            ],
        ]);

        $parser->parse($msg, json_decode($data));

        $this->assertEquals("
            <p>Hi Maisie</p>
            <p>PICS shows that you are the vacancy manager for the following vacancy which closed over 30 days ago:</p>
            <ul>
            <li><strong>Title:</strong> Apprentice Nursery Nurse at Bluebells Day Nursery</li>
            <li><strong>Employer:</strong> Just Childcare Limited</li>
            <li><strong>Closing Date:</strong> 18/07/2016</li>
            </ul>
            <ul>
            <li><strong>Title:</strong> Apprentice Nursery Nurse at Cherubs Day Nursery</li>
            <li><strong>Employer:</strong> Just Childcare Limited</li>
            <li><strong>Closing Date:</strong> 08/07/2016</li>
            </ul>
            <ul>
            <li><strong>Title:</strong> Apprentice Nursery Nurse at Little Stars Private Day Nursery</li>
            <li><strong>Employer:</strong> Just Childcare Limited</li>
            <li><strong>Closing Date:</strong> 18/07/2016</li>
            </ul>
        ", $parser->getMessage());
    }

}
