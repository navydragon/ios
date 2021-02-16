<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('show_questions')->nullable();
            $table->integer('passing_score')->nullable();
            $table->integer('attempt_time')->nullable()->default(30);
            $table->integer('max_attempts')->nullable()->default(30);
            $table->date('max_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_parameters');
    }
}
