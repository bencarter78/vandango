<?php

namespace Tests\Unit\Console\Commands\Classroom;

use Mail;
use Artisan;
use Carbon\Carbon;
use Tests\TestCase;
use App\Classroom\Models\User;
use App\Classroom\Models\Timetable;
use App\Mail\Classroom\UpcomingCourseReminder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group classroom
 */
class CourseReminderTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_sends_a_reminder_to_users()
    {
        Mail::fake();
        $user = factory(User::class)->create();
        $timetable = factory(Timetable::class)->create(['starts_at' => Carbon::now()->addDays(7)->addMinutes(60)]);
        $timetable->users()->attach($user->id);
        Artisan::call('classroom:reminder');

        Mail::assertSent(UpcomingCourseReminder::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}