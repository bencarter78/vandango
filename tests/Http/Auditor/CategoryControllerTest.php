<?php

namespace Tests\Http\Auditor;

use Tests\BrowserKitTest;
use App\Auditor\Categories\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group auditor
 */
class CategoryControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_displays_all_categories()
    {
        $this->actingAs($this->groupUser(['auditorAdmin', 'auditor']))
             ->visit('/auditor/categories')
             ->see('All Categories');
    }

    /** @test */
    function it_adds_a_new_category()
    {
        $this->actingAs($this->groupUser(['auditorAdmin', 'auditor']))
             ->visit('/auditor/categories')
             ->click('Create New Category')
             ->seePageIs('/auditor/categories/create')
             ->type('Test Category', 'name')
             ->select('#7FFFD4', 'color')
             ->press('Create')
             ->seePageIs('/auditor/categories')
             ->see('Test Category')
             ->seeInDatabase('auditor_categories', [
                 'name' => 'Test Category',
                 'color' => '#7FFFD4',
             ]);
    }

    /** @test */
    function it_edits_a_category()
    {
        $category = factory(Category::class)->create();

        $this->actingAs($this->groupUser(['auditorAdmin', 'auditor']))
             ->visit("/auditor/categories/{$category->id}/edit")
             ->type('My New Category', 'name')
             ->select('#7FFFD4', 'color')
             ->press('Update')
             ->seePageIs('/auditor/categories')
             ->see('My New Category')
             ->seeInDatabase('auditor_categories', [
                 'name' => 'My New Category',
                 'color' => '#7FFFD4',
             ]);
    }
}
