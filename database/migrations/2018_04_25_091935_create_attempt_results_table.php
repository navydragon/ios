<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attempt_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('answer_id')->unsigned();
            $table->boolean('checked')->default(false);
            $table->boolean('right')->default(false);;

            $table->foreign('attempt_id')->references('id')->on('test_attempts')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('test_questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('test_answers')->onDelete('cascade');
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
        Schema::dropIfExists('attempt_results');
    }
}
