<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->biginteger('category_id')->unsigned()->nullable();
            $table->integer('file_id')->unsigned()->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('knowledge_categories')
                ->onDelete('set null');
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_materials');
    }
}
