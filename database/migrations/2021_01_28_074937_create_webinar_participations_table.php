<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebinarParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar_participations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('webinar_id')->unsigned();
            $table->string('type');
            $table->datetime('participation_date');
            $table->timestamps();

            $table->foreign('webinar_id')
            ->references('id')
            ->on('webinars')
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
        Schema::dropIfExists('webinar_participations');
    }
}
