<?php

namespace Tests\Unit\Console\Commands\KeySafe;

use Tests\TestCase;
use App\KeySafe\Models\Key;
use App\Contracts\HttpClient;
use App\KeySafe\Mailers\KeySafeMailer;
use App\Console\Commands\KeySafe\KeyAssign;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group keysafe
 */
class KeyAssignTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    public function data()
    {
        return json_encode([
            "count" => 5,
            "error" => false,
            "data" => [
                [
                    "ident" => "86307",
                    "firstname" => "Rachel                                                                                              ",
                    "surname" => "Radcliffe                                                                                           ",
                    "lnr_email" => "rachelradcliffe@gmx.co.uk                                                                           ",
                    "adviser" => "Sharon Taylor",
                    "adv_email" => "Sharon.Taylor@totalpeople.co.uk                                                                     ",
                ],
                [
                    "ident" => "86310",
                    "firstname" => "Faye Ann                                                                                            ",
                    "surname" => "Hooley                                                                                              ",
                    "lnr_email" => "fayehooley@gmail.com                                                                                ",
                    "adviser" => "Kim Morton",
                    "adv_email" => "Kim.Morton@totalpeople.co.uk                                                                        ",
                ],
                [
                    "ident" => "86312",
                    "firstname" => "Thomas                                                                                              ",
                    "surname" => "Lewis                                                                                               ",
                    "lnr_email" => "tomlewis14@live.com                                                                                 ",
                    "adviser" => "Claire Humphreys",
                    "adv_email" => "Claire.Humphreys@totalpeople.co.uk                                                                  ",
                ],
                [
                    "ident" => "86363",
                    "firstname" => "Stephen                                                                                             ",
                    "surname" => "McGuinness                                                                                          ",
                    "lnr_email" => "stee42@live.co.uk                                                                                   ",
                    "adviser" => "Alison Heath",
                    "adv_email" => "Alison.Heath@totalpeople.co.uk                                                                      ",
                ],
                [
                    "ident" => "86436",
                    "firstname" => "Shahrokh                                                                                            ",
                    "surname" => "Rasekh                                                                                              ",
                    "lnr_email" => "RASEKHSHAHROKH@yahoo.co.uk                                                                          ",
                    "adviser" => "Alison Heath",
                    "adv_email" => "Alison.Heath@totalpeople.co.uk                                                                      ",
                ],
            ],
        ]);
    }

    /** @test */
    function it_assigns_a_code_to_a_learner()
    {
        factory(Key::class, 5)->create();
        $data = json_decode($this->data());

        $client = $this->mock(HttpClient::class);
        $client->shouldReceive('get');
        $client->shouldReceive('getContents')->andReturn($data);

        $mailer = $this->mock(KeySafeMailer::class);
        $mailer->shouldReceive('sendLearnerAccessCode')->times($data->count);
        $mailer->shouldReceive('sendProgAdminLearnerAccessCode')->times($data->count);
        $mailer->shouldReceive('sendLowStockLevelNotification')->once();

        $command = new KeyAssign($client, $mailer);
        $command->handle();
    }

    /** @test */
    function it_sends_an_email_when_stock_levels_are_low()
    {
        factory(Key::class, 5)->create();
        $data = json_decode($this->data());

        $client = $this->mock(HttpClient::class);
        $client->shouldReceive('get');
        $client->shouldReceive('getContents')->andReturn($data);

        $mailer = $this->mock(KeySafeMailer::class);
        $mailer->shouldReceive('sendLearnerAccessCode')->times($data->count);
        $mailer->shouldReceive('sendProgAdminLearnerAccessCode')->times($data->count);
        $mailer->shouldReceive('sendLowStockLevelNotification')->once();

        $command = new KeyAssign($client, $mailer);
        $command->handle();
    }

    /** @test */
    function it_does_not_send_an_email_when_stock_levels_are_above_the_threshold()
    {
        factory(Key::class, 50)->create();
        $data = json_decode($this->data());

        $client = $this->mock(HttpClient::class);
        $client->shouldReceive('get');
        $client->shouldReceive('getContents')->andReturn($data);

        $mailer = $this->mock(KeySafeMailer::class);
        $mailer->shouldReceive('sendLearnerAccessCode')->times($data->count);
        $mailer->shouldReceive('sendProgAdminLearnerAccessCode')->times($data->count);
        $mailer->shouldNotReceive('sendLowStockLevelNotification');

        $command = new KeyAssign($client, $mailer);
        $command->handle();
    }

    /** @test */
    function it_sends_an_email_when_the_learners_email_is_not_valid()
    {
        factory(Key::class, 15)->create();
        $data = json_decode(json_encode([
            "count" => 1,
            "error" => false,
            "data" => [
                [
                    "ident" => "86307",
                    "firstname" => "Rachel                                                                                              ",
                    "surname" => "Radcliffe                                                                                           ",
                    "lnr_email" => "rachelradcliffegmx.co.uk                                                                           ",
                    "adviser" => "Sharon Taylor",
                    "adv_email" => "Sharon.Taylor@totalpeople.co.uk                                                                     ",
                ],
            ],
        ]));

        $client = $this->mock(HttpClient::class);
        $client->shouldReceive('get');
        $client->shouldReceive('getContents')->andReturn($data);

        $mailer = $this->mock(KeySafeMailer::class);
        $mailer->shouldReceive('sendLearnerHasInvalidEmailNotification')->once();
        $mailer->shouldNotReceive('sendLearnerAccessCode');
        $mailer->shouldNotReceive('sendProgAdminLearnerAccessCode');
        $mailer->shouldNotReceive('sendLowStockLevelNotification');

        $command = new KeyAssign($client, $mailer);
        $command->handle();
    }
}
