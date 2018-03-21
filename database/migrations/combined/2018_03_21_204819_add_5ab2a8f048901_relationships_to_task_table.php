<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ab2a8f048901RelationshipsToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '133820_5ab2a4f7c8dde')->references('id')->on('task_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '133820_5ab2a4f7d76de')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('tasks', function(Blueprint $table) {
            if(Schema::hasColumn('tasks', 'status_id')) {
                $table->dropForeign('133820_5ab2a4f7c8dde');
                $table->dropIndex('133820_5ab2a4f7c8dde');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('tasks', 'user_id')) {
                $table->dropForeign('133820_5ab2a4f7d76de');
                $table->dropIndex('133820_5ab2a4f7d76de');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
