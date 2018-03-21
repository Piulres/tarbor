<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CrmDocumentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCrmDocument()
    {
        $admin = \App\User::find(1);
        $crm_document = factory('App\CrmDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_documents.index'))
                ->clickLink('Add new')
                ->select("customer_id", $crm_document->customer_id)
                ->type("name", $crm_document->name)
                ->type("description", $crm_document->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.crm_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='customer']", $crm_document->customer->first_name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $crm_document->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $crm_document->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\CrmDocument::first()->file . "']");
        });
    }

    public function testEditCrmDocument()
    {
        $admin = \App\User::find(1);
        $crm_document = factory('App\CrmDocument')->create();
        $crm_document2 = factory('App\CrmDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_document, $crm_document2) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_documents.index'))
                ->click('tr[data-entry-id="' . $crm_document->id . '"] .btn-info')
                ->select("customer_id", $crm_document2->customer_id)
                ->type("name", $crm_document2->name)
                ->type("description", $crm_document2->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.crm_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='customer']", $crm_document2->customer->first_name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $crm_document2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $crm_document2->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\CrmDocument::first()->file . "']");
        });
    }

    public function testShowCrmDocument()
    {
        $admin = \App\User::find(1);
        $crm_document = factory('App\CrmDocument')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $crm_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_documents.index'))
                ->click('tr[data-entry-id="' . $crm_document->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='customer']", $crm_document->customer->first_name)
                ->assertSeeIn("td[field-key='name']", $crm_document->name)
                ->assertSeeIn("td[field-key='description']", $crm_document->description);
        });
    }

}
