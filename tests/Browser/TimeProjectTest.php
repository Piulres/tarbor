<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TimeProjectTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->clickLink('Add new')
                ->type("name", $time_project->name)
                ->press('Save')
                ->assertRouteIs('admin.time_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_project->name);
        });
    }

    public function testEditTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->create();
        $time_project2 = factory('App\TimeProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_project, $time_project2) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->click('tr[data-entry-id="' . $time_project->id . '"] .btn-info')
                ->type("name", $time_project2->name)
                ->press('Update')
                ->assertRouteIs('admin.time_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_project2->name);
        });
    }

    public function testShowTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $time_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->click('tr[data-entry-id="' . $time_project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $time_project->name);
        });
    }

}
