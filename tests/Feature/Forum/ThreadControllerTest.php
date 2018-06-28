<?php

namespace Tests\Feature\Forum;

use Tests\TestCase;
use App\Forum\User;
use App\Forum\Reply;
use App\Forum\Thread;
use App\Forum\Channel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group forum
 */
class ThreadControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function authorised_users_can_see_the_latest_threads()
    {
        $user = factory(User::class)->create();
        $threads = factory(Thread::class, 5)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($threads->first()->title);
        $response->assertSee($threads->first()->excerpt());
        $response->assertSee($threads->first()->channel->name);
        $response->assertSee($threads->first()->creator->fullName);
    }

    /** @test */
    public function it_displays_threads_from_a_channel()
    {
        $user = factory(User::class)->create();
        $threadA = factory(Thread::class)->create();
        $threadB = factory(Thread::class)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.index', $threadA->channel->slug));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($threadA->title);
        $response->assertDontSee($threadB->title);
    }

    /** @test */
    public function it_displays_a_thread()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.show', $thread->slug));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_increments_the_trending_count_for_the_thread()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.show', $thread->slug));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(1, Cache::get('trending_threads'));
        $this->assertEquals($thread->title, Cache::get('trending_threads')->first()->title);
    }

    /** @test */
    public function it_increments_the_views_count_for_the_thread()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.show', $thread->slug));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(1, $thread->fresh()->views);
    }

    /** @test */
    public function it_displays_the_creates_thread_form()
    {
        $user = factory(User::class)->create();
        $channels = factory(Channel::class, 5)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->data('channels')->assertEquals($channels->sortBy('name'));
    }

    /** @test */
    public function it_returns_all_threads_by_a_given_user()
    {
        $user = factory(User::class)->create();
        $threadA = factory(Thread::class)->create(['user_id' => $user->id]);
        $threadB = factory(Thread::class)->create();

        $response = $this->actingAs($user)->get(route('forum.threads.index') . "?by=$user->username");

        $response->assertStatus(Response::HTTP_OK);
        $response->data('threads')->assertContains($threadA);
        $response->data('threads')->assertNotContains($threadB);
    }

    /** @test */
    public function it_returns_all_unanswered_threads()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $threads = factory(Thread::class, 2)->create();
        $answeredThread = factory(Reply::class)->create()->thread;

        $response = $this->actingAs($user)->get(route('forum.threads.index') . "?unanswered=true");

        $response->assertStatus(Response::HTTP_OK);
        $response->data('threads')->assertEquals($threads);
        $response->data('threads')->assertNotContains($answeredThread);
    }

    /** @test */
    public function it_returns_the_most_popular_threads()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $threadA = factory(Thread::class)->create();
        $threadB = factory(Thread::class)->create();
        $threadC = factory(Thread::class)->create();
        factory(Reply::class, 5)->create(['thread_id' => $threadC]);
        factory(Reply::class, 3)->create(['thread_id' => $threadA]);
        factory(Reply::class, 1)->create(['thread_id' => $threadB]);

        $response = $this->actingAs($user)->get(route('forum.threads.index') . "?popular=true");

        $response->assertStatus(Response::HTTP_OK);
        $response->data('threads')->assertEquals([$threadC, $threadA, $threadB]);
    }
}
