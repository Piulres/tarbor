<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f0a9669RelationshipsToCrmDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_documents', function(Blueprint $table) {
            if (!Schema::hasColumn('crm_documents', 'customer_id')) {
                $table->integer('customer_id')->unsigned()->nullable();
                $table->foreign('customer_id', '133802_5ab29ba43c885')->references('id')->on('crm_customers')->onDelete('cascade');
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
        Schema::table('crm_documents', function(Blueprint $table) {
            if(Schema::hasColumn('crm_documents', 'customer_id')) {
                $table->dropForeign('133802_5ab29ba43c885');
                $table->dropIndex('133802_5ab29ba43c885');
                $table->dropColumn('customer_id');
            }
            
        });
    }
}
