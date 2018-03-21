<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExpenseTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->clickLink('Add new')
                ->select("expense_category_id", $expense->expense_category_id)
                ->type("entry_date", $expense->entry_date)
                ->type("amount", $expense->amount)
                ->press('Save')
                ->assertRouteIs('admin.expenses.index')
                ->assertSeeIn("tr:last-child td[field-key='expense_category']", $expense->expense_category->name)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $expense->amount);
        });
    }

    public function testEditExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->create();
        $expense2 = factory('App\Expense')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense, $expense2) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->click('tr[data-entry-id="' . $expense->id . '"] .btn-info')
                ->select("expense_category_id", $expense2->expense_category_id)
                ->type("entry_date", $expense2->entry_date)
                ->type("amount", $expense2->amount)
                ->press('Update')
                ->assertRouteIs('admin.expenses.index')
                ->assertSeeIn("tr:last-child td[field-key='expense_category']", $expense2->expense_category->name)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $expense2->amount);
        });
    }

    public function testShowExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $expense) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->click('tr[data-entry-id="' . $expense->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='expense_category']", $expense->expense_category->name)
                ->assertSeeIn("td[field-key='entry_date']", $expense->entry_date)
                ->assertSeeIn("td[field-key='amount']", $expense->amount);
        });
    }

}
