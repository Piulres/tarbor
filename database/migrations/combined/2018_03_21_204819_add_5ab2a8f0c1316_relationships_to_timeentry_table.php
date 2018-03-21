<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f0c1316RelationshipsToTimeEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_entries', function(Blueprint $table) {
            if (!Schema::hasColumn('time_entries', 'work_type_id')) {
                $table->integer('work_type_id')->unsigned()->nullable();
                $table->foreign('work_type_id', '133806_5ab29bc71f332')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('time_entries', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '133806_5ab29bc72c626')->references('id')->on('time_projects')->onDelete('cascade');
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
        Schema::table('time_entries', function(Blueprint $table) {
            if(Schema::hasColumn('time_entries', 'work_type_id')) {
                $table->dropForeign('133806_5ab29bc71f332');
                $table->dropIndex('133806_5ab29bc71f332');
                $table->dropColumn('work_type_id');
            }
            if(Schema::hasColumn('time_entries', 'project_id')) {
                $table->dropForeign('133806_5ab29bc72c626');
                $table->dropIndex('133806_5ab29bc72c626');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
