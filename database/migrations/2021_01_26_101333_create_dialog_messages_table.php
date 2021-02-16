<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialogMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialog_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message');
            $table->biginteger('dialog_id')->unsigned();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('dialog_id')
            ->references('id')
            ->on('dialogs')
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
        Schema::dropIfExists('dialog_messages');
    }
}
