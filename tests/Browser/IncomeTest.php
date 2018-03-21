<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IncomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->clickLink('Add new')
                ->select("income_category_id", $income->income_category_id)
                ->type("entry_date", $income->entry_date)
                ->type("amount", $income->amount)
                ->press('Save')
                ->assertRouteIs('admin.incomes.index')
                ->assertSeeIn("tr:last-child td[field-key='income_category']", $income->income_category->name)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $income->amount);
        });
    }

    public function testEditIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->create();
        $income2 = factory('App\Income')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income, $income2) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->click('tr[data-entry-id="' . $income->id . '"] .btn-info')
                ->select("income_category_id", $income2->income_category_id)
                ->type("entry_date", $income2->entry_date)
                ->type("amount", $income2->amount)
                ->press('Update')
                ->assertRouteIs('admin.incomes.index')
                ->assertSeeIn("tr:last-child td[field-key='income_category']", $income2->income_category->name)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $income2->amount);
        });
    }

    public function testShowIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $income) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->click('tr[data-entry-id="' . $income->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='income_category']", $income->income_category->name)
                ->assertSeeIn("td[field-key='entry_date']", $income->entry_date)
                ->assertSeeIn("td[field-key='amount']", $income->amount);
        });
    }

}
