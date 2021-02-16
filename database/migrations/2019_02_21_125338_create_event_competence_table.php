<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCompetenceTable extends Migration
{
   public function up()
    {
        Schema::create('event_competence', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('competence_id')->unsigned();
            $table->timestamps();
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
            $table->foreign('competence_id')
                  ->references('id')
                  ->on('competences')
                  ->onDelete('cascade');
            $table->primary(['event_id', 'competence_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_competence');
    }
}
