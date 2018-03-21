<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f07c07aRelationshipsToCrmCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_customers', function(Blueprint $table) {
            if (!Schema::hasColumn('crm_customers', 'crm_status_id')) {
                $table->integer('crm_status_id')->unsigned()->nullable();
                $table->foreign('crm_status_id', '133800_5ab29b932738f')->references('id')->on('crm_statuses')->onDelete('cascade');
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
        Schema::table('crm_customers', function(Blueprint $table) {
            if(Schema::hasColumn('crm_customers', 'crm_status_id')) {
                $table->dropForeign('133800_5ab29b932738f');
                $table->dropIndex('133800_5ab29b932738f');
                $table->dropColumn('crm_status_id');
            }
            
        });
    }
}
