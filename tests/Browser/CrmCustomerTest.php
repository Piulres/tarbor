<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CrmCustomerTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCrmCustomer()
    {
        $admin = \App\User::find(1);
        $crm_customer = factory('App\CrmCustomer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_customer) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_customers.index'))
                ->clickLink('Add new')
                ->type("first_name", $crm_customer->first_name)
                ->type("last_name", $crm_customer->last_name)
                ->select("crm_status_id", $crm_customer->crm_status_id)
                ->type("email", $crm_customer->email)
                ->type("phone", $crm_customer->phone)
                ->type("address", $crm_customer->address)
                ->type("skype", $crm_customer->skype)
                ->type("website", $crm_customer->website)
                ->type("description", $crm_customer->description)
                ->press('Save')
                ->assertRouteIs('admin.crm_customers.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $crm_customer->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $crm_customer->last_name)
                ->assertSeeIn("tr:last-child td[field-key='crm_status']", $crm_customer->crm_status->title)
                ->assertSeeIn("tr:last-child td[field-key='email']", $crm_customer->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $crm_customer->phone)
                ->assertSeeIn("tr:last-child td[field-key='address']", $crm_customer->address)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $crm_customer->skype)
                ->assertSeeIn("tr:last-child td[field-key='website']", $crm_customer->website)
                ->assertSeeIn("tr:last-child td[field-key='description']", $crm_customer->description);
        });
    }

    public function testEditCrmCustomer()
    {
        $admin = \App\User::find(1);
        $crm_customer = factory('App\CrmCustomer')->create();
        $crm_customer2 = factory('App\CrmCustomer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $crm_customer, $crm_customer2) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_customers.index'))
                ->click('tr[data-entry-id="' . $crm_customer->id . '"] .btn-info')
                ->type("first_name", $crm_customer2->first_name)
                ->type("last_name", $crm_customer2->last_name)
                ->select("crm_status_id", $crm_customer2->crm_status_id)
                ->type("email", $crm_customer2->email)
                ->type("phone", $crm_customer2->phone)
                ->type("address", $crm_customer2->address)
                ->type("skype", $crm_customer2->skype)
                ->type("website", $crm_customer2->website)
                ->type("description", $crm_customer2->description)
                ->press('Update')
                ->assertRouteIs('admin.crm_customers.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $crm_customer2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $crm_customer2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='crm_status']", $crm_customer2->crm_status->title)
                ->assertSeeIn("tr:last-child td[field-key='email']", $crm_customer2->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $crm_customer2->phone)
                ->assertSeeIn("tr:last-child td[field-key='address']", $crm_customer2->address)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $crm_customer2->skype)
                ->assertSeeIn("tr:last-child td[field-key='website']", $crm_customer2->website)
                ->assertSeeIn("tr:last-child td[field-key='description']", $crm_customer2->description);
        });
    }

    public function testShowCrmCustomer()
    {
        $admin = \App\User::find(1);
        $crm_customer = factory('App\CrmCustomer')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $crm_customer) {
            $browser->loginAs($admin)
                ->visit(route('admin.crm_customers.index'))
                ->click('tr[data-entry-id="' . $crm_customer->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='first_name']", $crm_customer->first_name)
                ->assertSeeIn("td[field-key='last_name']", $crm_customer->last_name)
                ->assertSeeIn("td[field-key='crm_status']", $crm_customer->crm_status->title)
                ->assertSeeIn("td[field-key='email']", $crm_customer->email)
                ->assertSeeIn("td[field-key='phone']", $crm_customer->phone)
                ->assertSeeIn("td[field-key='address']", $crm_customer->address)
                ->assertSeeIn("td[field-key='skype']", $crm_customer->skype)
                ->assertSeeIn("td[field-key='website']", $crm_customer->website)
                ->assertSeeIn("td[field-key='description']", $crm_customer->description);
        });
    }

}
