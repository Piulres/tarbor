<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f11a0a4RelationshipsToExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function(Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'expense_category_id')) {
                $table->integer('expense_category_id')->unsigned()->nullable();
                $table->foreign('expense_category_id', '133812_5ab29bf3d16aa')->references('id')->on('expense_categories')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function(Blueprint $table) {
            if(Schema::hasColumn('expenses', 'expense_category_id')) {
                $table->dropForeign('133812_5ab29bf3d16aa');
                $table->dropIndex('133812_5ab29bf3d16aa');
                $table->dropColumn('expense_category_id');
            }
            
        });
    }
}
