<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->string('name');
            $table->integer('access_level')->default(0);
            $table->boolean('visible')->default(true);
            $table->boolean('closed')->default(false);
            $table->timestamps();

            $table->foreign('author_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('forum_id')
                  ->references('id')
                  ->on('forums')
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
        Schema::dropIfExists('forum_threads');
    }
}
