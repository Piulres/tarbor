<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TimeEntryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->clickLink('Add new')
                ->select("work_type_id", $time_entry->work_type_id)
                ->select("project_id", $time_entry->project_id)
                ->type("start_time", $time_entry->start_time)
                ->type("end_time", $time_entry->end_time)
                ->press('Save')
                ->assertRouteIs('admin.time_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='work_type']", $time_entry->work_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $time_entry->project->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $time_entry->start_time)
                ->assertSeeIn("tr:last-child td[field-key='end_time']", $time_entry->end_time);
        });
    }

    public function testEditTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->create();
        $time_entry2 = factory('App\TimeEntry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_entry, $time_entry2) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->click('tr[data-entry-id="' . $time_entry->id . '"] .btn-info')
                ->select("work_type_id", $time_entry2->work_type_id)
                ->select("project_id", $time_entry2->project_id)
                ->type("start_time", $time_entry2->start_time)
                ->type("end_time", $time_entry2->end_time)
                ->press('Update')
                ->assertRouteIs('admin.time_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='work_type']", $time_entry2->work_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $time_entry2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $time_entry2->start_time)
                ->assertSeeIn("tr:last-child td[field-key='end_time']", $time_entry2->end_time);
        });
    }

    public function testShowTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $time_entry) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->click('tr[data-entry-id="' . $time_entry->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='work_type']", $time_entry->work_type->name)
                ->assertSeeIn("td[field-key='project']", $time_entry->project->name)
                ->assertSeeIn("td[field-key='start_time']", $time_entry->start_time)
                ->assertSeeIn("td[field-key='end_time']", $time_entry->end_time);
        });
    }

}
