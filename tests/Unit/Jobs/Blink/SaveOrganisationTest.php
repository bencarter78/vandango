<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Blink\Models\Organisation;
use App\Jobs\Blink\SaveOrganisation;
use App\Blink\Repositories\Organisations;
use App\Events\Blink\OrganisationWasAdded;

/**
 * @group blink
 */
class SaveOrganisationTest extends TestCase
{
    /** @test */
    public function it_returns_the_organisation_from_a_given_id()
    {
        $repo = $this->mock(Organisations::class);
        $repo->shouldReceive('requireById')->andReturn(new Organisation());

        $job = new SaveOrganisation(['organisation_id' => 1]);
        $this->assertInstanceOf(Organisation::class, $job->handle($repo));
    }

    /** @test */
    public function it_returns_the_organisation_from_a_given_name()
    {
        $this->expectsEvents(OrganisationWasAdded::class);
        $repo = $this->mock(Organisations::class);
        $repo->shouldReceive('add')->andReturn(new Organisation());

        $job = new SaveOrganisation(['organisation_name' => 'ABC Ltd']);
        $this->assertInstanceOf(Organisation::class, $job->handle($repo));
    }
}
