<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f0f2811RelationshipsToIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function(Blueprint $table) {
            if (!Schema::hasColumn('incomes', 'income_category_id')) {
                $table->integer('income_category_id')->unsigned()->nullable();
                $table->foreign('income_category_id', '133811_5ab29beac73d8')->references('id')->on('income_categories')->onDelete('cascade');
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
        Schema::table('incomes', function(Blueprint $table) {
            if(Schema::hasColumn('incomes', 'income_category_id')) {
                $table->dropForeign('133811_5ab29beac73d8');
                $table->dropIndex('133811_5ab29beac73d8');
                $table->dropColumn('income_category_id');
            }
            
        });
    }
}
