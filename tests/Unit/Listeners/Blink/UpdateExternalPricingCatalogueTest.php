<?php

namespace Tests\Unit\Listeners\Blink;

use Tests\TestCase;
use App\Blink\Models\Course;
use App\Contracts\HttpClient;
use App\Events\Blink\CoursePriceListWasUpdated;
use App\Listeners\Blink\UpdateExternalPricingCatalogue;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class UpdateExternalPricingCatalogueTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_sends_a_request_to_the_external_pricing_api()
    {
        $course = factory(Course::class)->make();
        $event = $this->mock(CoursePriceListWasUpdated::class);
        $event->course = $course;
        $client = $this->mock(HttpClient::class);
        $client->shouldReceive('put')->once();
        (new UpdateExternalPricingCatalogue($client))->handle($event);
    }
}
