<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1521654689CrmDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('crm_documents')) {
            Schema::create('crm_documents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_documents');
    }
}
