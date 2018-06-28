<?php

namespace Tests\Feature\Api\V1\UserManager;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\Notifications\FakeNotification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class NotificationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_displays_all_notifications_for_a_given_user()
    {
        $user = factory(User::class)->create();
        $user->notify(new FakeNotification());
        $user->notify(new FakeNotification());
        $user->notify(new FakeNotification());

        $response = $this->json('GET', route('api.usermanager.users.notifications.index', $user->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(3, $response->data('data')->count());
    }

    /** @test */
    public function it_marks_the_notification_as_read()
    {
        $user = factory(User::class)->create();
        $user->notify(new FakeNotification());

        $response = $this->json('PATCH', route('api.usermanager.users.notifications.update', $user->notifications->first()->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(0, $user->unreadNotifications);
    }
}
