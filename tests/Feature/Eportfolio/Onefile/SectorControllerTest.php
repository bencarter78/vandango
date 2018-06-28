<?php

namespace Tests\Feature\Eportfolio\Onefile;

use Tests\TestCase;
use App\Apply\Models\Sector;
use App\UserManager\Users\User;
use App\Eportfolios\Models\Centre;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group eportfolio
 */
class SectorControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_displays_all_sectors_with_their_linked_centres()
    {
        $sector = factory(Sector::class)->create(['name' => 'Example Sector']);
        $centre = factory(Centre::class)->create(['name' => 'Example Centre']);
        $sector->syncCentres($centre);

        $response = $this->actingAs(factory(User::class)->create())->get(route('eportfolios.onefile.sectors.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas('sectors');
        $response->assertSee('Example Sector');
    }

    /** @test */
    public function unauthorised_users_can_not_view_the_edit_form()
    {
        $sector = factory(Sector::class)->create();

        $response = $this->actingAs(factory(User::class)->create())->get(route('eportfolios.onefile.sectors.edit', $sector->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_displays_the_form_to_link_a_sector_to_eportfolio_centres()
    {
        $adminUser = $this->admin('eportfolioAdmin');
        $sector = factory(Sector::class)->create();
        $centreA = factory(Centre::class)->create();
        $centreB = factory(Centre::class)->create();

        $response = $this->actingAs($adminUser)->get(route('eportfolios.onefile.sectors.edit', $sector->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewHas('sector');
        $response->assertViewHas('centres');
        $response->assertSee($centreA->name);
        $response->assertSee($centreB->name);
    }

    /** @test */
    public function unauthorised_users_can_not_link_sectors_to_centres()
    {
        $sector = factory(Sector::class)->create();

        $response = $this->actingAs(factory(User::class)->create())->patch(route('eportfolios.onefile.sectors.update', $sector->id, [1, 2, 3]));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('error');
    }

    /** @test */
    public function it_links_a_sector_to_eportfolio_centres()
    {
        $adminUser = $this->admin('eportfolioAdmin');
        $sector = factory(Sector::class)->create(['name' => 'Example Sector']);
        $centreA = factory(Centre::class)->create(['name' => 'Example Centre']);
        $centreB = factory(Centre::class)->create(['name' => 'Example Centre']);

        $response = $this->actingAs($adminUser)->patch(route('eportfolios.onefile.sectors.update', $sector->id), [
            'centre_id' => [$centreA->id, $centreB->id],
        ]);

        $this->assertCount(2, $sector->eportfolioCentres);
        $response->assertRedirect(route('eportfolios.onefile.sectors.index'));
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_sync_a_sectors_eportfolio_centres()
    {
        $adminUser = $this->admin('eportfolioAdmin');
        $sector = factory(Sector::class)->create(['name' => 'Example Sector']);
        $centreA = factory(Centre::class)->create(['name' => 'Example Centre']);
        $centreB = factory(Centre::class)->create(['name' => 'Example Centre']);
        $centreC = factory(Centre::class)->create(['name' => 'Example Centre']);
        $sector->syncCentres($centreA);

        $this->actingAs($adminUser)->patch(route('eportfolios.onefile.sectors.update', $sector->id), [
            'centre_id' => [$centreB->id, $centreC->id],
        ]);

        $this->assertCount(2, $sector->eportfolioCentres);
        $this->assertTrue($sector->eportfolioCentres->first()->is($centreB));
        $this->assertTrue($sector->eportfolioCentres->last()->is($centreC));
    }
}
