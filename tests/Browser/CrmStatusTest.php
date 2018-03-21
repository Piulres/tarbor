<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CrmStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCrmStatus()
    {
        $admin = \App\User::find(1);
        $crm_status = factory('App\CrmStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_statuses.index'))
                ->clickLink('Add new')
                ->type("title", $crm_status->title)
                ->press('Save')
                ->assertRouteIs('admin.crm_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $crm_status->title);
        });
    }

    public function testEditCrmStatus()
    {
        $admin = \App\User::find(1);
        $crm_status = factory('App\CrmStatus')->create();
        $crm_status2 = factory('App\CrmStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_status, $crm_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_statuses.index'))
                ->click('tr[data-entry-id="' . $crm_status->id . '"] .btn-info')
                ->type("title", $crm_status2->title)
                ->press('Update')
                ->assertRouteIs('admin.crm_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $crm_status2->title);
        });
    }

    public function testShowCrmStatus()
    {
        $admin = \App\User::find(1);
        $crm_status = factory('App\CrmStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $crm_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_statuses.index'))
                ->click('tr[data-entry-id="' . $crm_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $crm_status->title);
        });
    }

}
