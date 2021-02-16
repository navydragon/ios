<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('author_id')->unsigned()->nullable();
            $table->text('conditions')->nullable();
            $table->text('description')->nullable();
            $table->text('task')->nullable();
            $table->text('possible_errors')->nullable();
            $table->text('error_effects')->nullable();
            $table->text('algorithms')->nullable();
            $table->text('conclusions')->nullable();
            $table->boolean('is_recommend')->default(false);
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_cases');
    }
}
