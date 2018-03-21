<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CrmNoteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCrmNote()
    {
        $admin = \App\User::find(1);
        $crm_note = factory('App\CrmNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_notes.index'))
                ->clickLink('Add new')
                ->select("customer_id", $crm_note->customer_id)
                ->type("note", $crm_note->note)
                ->press('Save')
                ->assertRouteIs('admin.crm_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='customer']", $crm_note->customer->first_name)
                ->assertSeeIn("tr:last-child td[field-key='note']", $crm_note->note);
        });
    }

    public function testEditCrmNote()
    {
        $admin = \App\User::find(1);
        $crm_note = factory('App\CrmNote')->create();
        $crm_note2 = factory('App\CrmNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_note, $crm_note2) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_notes.index'))
                ->click('tr[data-entry-id="' . $crm_note->id . '"] .btn-info')
                ->select("customer_id", $crm_note2->customer_id)
                ->type("note", $crm_note2->note)
                ->press('Update')
                ->assertRouteIs('admin.crm_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='customer']", $crm_note2->customer->first_name)
                ->assertSeeIn("tr:last-child td[field-key='note']", $crm_note2->note);
        });
    }

    public function testShowCrmNote()
    {
        $admin = \App\User::find(1);
        $crm_note = factory('App\CrmNote')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $crm_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_notes.index'))
                ->click('tr[data-entry-id="' . $crm_note->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='customer']", $crm_note->customer->first_name)
                ->assertSeeIn("td[field-key='note']", $crm_note->note);
        });
    }

}
