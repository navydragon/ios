<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsInLearningCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_cases', function (Blueprint $table) {
            $table->longtext('conditions')->nullable()->change();
            $table->longtext('description')->nullable()->change();
            $table->longtext('task')->nullable()->change();
            $table->longtext('possible_errors')->nullable()->change();
            $table->longtext('error_effects')->nullable()->change();
            $table->longtext('algorithms')->nullable()->change();
            $table->longtext('conclusions')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learning_cases', function (Blueprint $table) {
            //
        });
    }
}
