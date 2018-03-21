<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f09377bRelationshipsToCrmNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_notes', function(Blueprint $table) {
            if (!Schema::hasColumn('crm_notes', 'customer_id')) {
                $table->integer('customer_id')->unsigned()->nullable();
                $table->foreign('customer_id', '133801_5ab29b9b771be')->references('id')->on('crm_customers')->onDelete('cascade');
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
        Schema::table('crm_notes', function(Blueprint $table) {
            if(Schema::hasColumn('crm_notes', 'customer_id')) {
                $table->dropForeign('133801_5ab29b9b771be');
                $table->dropIndex('133801_5ab29b9b771be');
                $table->dropColumn('customer_id');
            }
            
        });
    }
}
