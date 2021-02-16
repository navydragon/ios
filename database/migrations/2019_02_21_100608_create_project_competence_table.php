<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCompetenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_competence', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('competence_id')->unsigned();
            $table->timestamps();
            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');
            $table->foreign('competence_id')
                  ->references('id')
                  ->on('competences')
                  ->onDelete('cascade');
            $table->primary(['project_id', 'competence_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_competence');
    }
}
