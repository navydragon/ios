<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stage_id')->unsigned();
            $table->string('name');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('responsible')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('stage_id')
                  ->references('id')
                  ->on('project_stages')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_events');
    }
}
