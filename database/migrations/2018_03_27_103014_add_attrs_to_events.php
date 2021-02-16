<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttrsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function($table)
        {
            $table->integer('project_stage_id')->unsigned()->index();
            $table->foreign('project_stage_id')->references('id')->on('project_stages')->onDelete('cascade');
            $table->integer('event_type_id')->unsigned()->index();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->integer('source_id');
            //$table->primary(['project_stage_id', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
