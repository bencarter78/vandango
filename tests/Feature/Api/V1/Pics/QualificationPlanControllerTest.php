<?php

namespace Tests\Feature\Api\V1\Pics;

use Tests\TestCase;
use App\Pics\QualificationPlan;
use App\UserManager\Sectors\Sector;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group datastore
 */
class QualificationPlanControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_qualification_plans()
    {
        $plan = factory(QualificationPlan::class)->create();

        $this->json('GET', route('api.datastore.qualification-plans.index'))
             ->assertStatus(Response::HTTP_OK)
             ->assertJson(['data' => [$plan->toArray()]]);
    }

    /** @test */
    public function it_returns_all_qualification_plans_matching_a_given_sector_id()
    {
        $sector = factory(Sector::class)->create();
        $planA = factory(QualificationPlan::class)->create();
        $planB = factory(QualificationPlan::class)->create(['sector_id' => $sector->id]);

        $this->json('GET', route('api.datastore.qualification-plans.index', ['sector_id' => $sector->id]))
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonMissing(['plan' => $planA->plan])
             ->assertJson(['data' => $planB->toArray()]);
    }
}
