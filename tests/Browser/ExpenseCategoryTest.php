<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExpenseCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->clickLink('Add new')
                ->type("name", $expense_category->name)
                ->press('Save')
                ->assertRouteIs('admin.expense_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $expense_category->name);
        });
    }

    public function testEditExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->create();
        $expense_category2 = factory('App\ExpenseCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense_category, $expense_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->click('tr[data-entry-id="' . $expense_category->id . '"] .btn-info')
                ->type("name", $expense_category2->name)
                ->press('Update')
                ->assertRouteIs('admin.expense_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $expense_category2->name);
        });
    }

    public function testShowExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $expense_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->click('tr[data-entry-id="' . $expense_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $expense_category->name);
        });
    }

}
