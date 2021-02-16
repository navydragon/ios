<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeMaterialTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_material_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('material_id')->unsigned();
            $table->string('tag');
            $table->timestamps();

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
        Schema::dropIfExists('knowledge_material_tags');
    }
}
