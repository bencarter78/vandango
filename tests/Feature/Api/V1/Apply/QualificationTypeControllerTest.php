<?php

namespace Tests\Feature\Api\V1\Apply;

use Tests\TestCase;
use App\Apply\Models\QualificationType;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group apply
 */
class QualificationTypeControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_all_programme_types()
    {
        $qualType = factory(QualificationType::class)->create();

        $this->json('GET', route('api.apply.qualification-types.index'))
             ->assertStatus(200)
             ->assertJson(['data' => [$qualType->toArray()]]);
    }

    /** @test */
    public function it_returns_all_programme_types_that_match_a_given_type()
    {
        $employedQualType = factory(QualificationType::class)->states('employed')->create();
        $nonEmployedQualType = factory(QualificationType::class)->states('nonEmployed')->create();

        $this->json('GET', route('api.apply.qualification-types.index', ['type' => 'employed']))
             ->assertStatus(200)
             ->assertJsonMissing(['name' => $nonEmployedQualType->name])
             ->assertJson(['data' => [$employedQualType->toArray()]]);
    }
}
