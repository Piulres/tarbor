<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IncomeCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->clickLink('Add new')
                ->type("name", $income_category->name)
                ->press('Save')
                ->assertRouteIs('admin.income_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $income_category->name);
        });
    }

    public function testEditIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->create();
        $income_category2 = factory('App\IncomeCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_category, $income_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->click('tr[data-entry-id="' . $income_category->id . '"] .btn-info')
                ->type("name", $income_category2->name)
                ->press('Update')
                ->assertRouteIs('admin.income_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $income_category2->name);
        });
    }

    public function testShowIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $income_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->click('tr[data-entry-id="' . $income_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $income_category->name);
        });
    }

}
