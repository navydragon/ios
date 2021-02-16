<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCriteriaAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_criteria_assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('expert_id')->unsigned();
            $table->integer('criteria_id')->unsigned();
            $table->float('mark')->default(0);
            $table->timestamps();

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('expert_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('criteria_id')
                  ->references('id')
                  ->on('event_criterias')
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
        Schema::dropIfExists('event_criteria_assessments');
    }
}
