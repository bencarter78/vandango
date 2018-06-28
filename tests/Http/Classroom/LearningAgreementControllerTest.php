<?php

namespace Tests\Http\Classroom;

use Tests\BrowserKitTest;
use Tests\Traits\RoomMate;
use App\Classroom\Models\User;
use App\Classroom\Models\Course;
use App\Classroom\Models\Timetable;
use App\Classroom\Models\LearningAgreement;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group classroom
 */
class LearningAgreementControllerTest extends BrowserKitTest
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_displays_a_list_of_user_learning_agreements()
    {
        $user = factory(User::class)->create();

        $timetable = factory(Timetable::class)->create([
            'course_id' => factory(Course::class)->create(['is_agreement_required' => 1])->id,
            'room_id' => $this->rooms()->id,
        ]);

        $timetable->users()->attach($user->id, ['cost' => $timetable->course->cost]);

        LearningAgreement::create(['user_id' => $user->id, 'timetable_id' => $timetable->id]);

        $this->actingAs($user)->visit('/classroom/me')->see('Sign')->see($timetable->course->name);
    }

    /** @test */
    public function it_displays_the_agreement_form_to_sign()
    {
        $user = factory(User::class)->create();

        $timetable = factory(Timetable::class)->create([
            'course_id' => factory(Course::class)->create(['is_agreement_required' => 1])->id,
            'room_id' => $this->rooms()->id,
        ]);

        $timetable->users()->attach($user->id, ['cost' => $timetable->course->cost]);

        $agreement = LearningAgreement::create(['user_id' => $user->id, 'timetable_id' => $timetable->id]);

        $this->actingAs($user)->visit('/classroom/me/learning-agreements/' . $agreement->id . '/edit')->see($timetable->course->name);
    }


    /** @test */
    public function it_submits_the_learning_agreement_with_the_users_password()
    {
        $user = factory(User::class)->create(['password' => bcrypt('secret')]);

        $timetable = factory(Timetable::class)->create([
            'course_id' => factory(Course::class)->create(['is_agreement_required' => 1])->id,
            'room_id' => $this->rooms()->id,
        ]);

        $timetable->users()->attach($user->id, ['cost' => $timetable->course->cost]);

        $agreement = LearningAgreement::create(['user_id' => $user->id, 'timetable_id' => $timetable->id]);

        $this->actingAs($user)
             ->visit('/classroom/me/learning-agreements/' . $agreement->id . '/edit')
             ->click('I Agree')
             ->type('secret', 'password')
             ->press('I Agree')
             ->seePageIs('/classroom/me')
             ->see('Agreed on')
             ->see('success');
    }
}
