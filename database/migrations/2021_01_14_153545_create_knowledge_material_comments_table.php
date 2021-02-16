<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeMaterialCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_material_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('material_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->longText('message');
            $table->timestamps();

            $table->foreign('author_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('material_id')
                  ->references('id')
                  ->on('knowledge_materials')
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
        Schema::dropIfExists('knowledge_material_comments');
    }
}
