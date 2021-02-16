<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->biginteger('parent_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('knowledge_categories')
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
        Schema::dropIfExists('knowledge_categories');
    }
}
