<?php

namespace Tests\Feature\Api\V1\Eportfolio;

use Tests\TestCase;
use App\Eportfolios\Models\Centre;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group eportfolio
 */
class CentreControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_centres()
    {
        $centres = factory(Centre::class, 3)->create();

        $response = $this->json('GET', route('api.eportfolios.centres.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->data('data')->assertEquals($centres->sortBy('name'));
    }
}
