<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('learning_case_id')->unsigned();
            $table->longtext('task');
            $table->integer('sort');
            $table->timestamps();
            $table->foreign('learning_case_id')->references('id')->on('learning_cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_tasks');
    }
}
