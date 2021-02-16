<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_thread_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->longText('message');
            $table->timestamps();

            $table->foreign('author_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('forum_thread_id')
                  ->references('id')
                  ->on('forum_threads')
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
        Schema::dropIfExists('thread_messages');
    }
}
