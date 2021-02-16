<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
             $table->string('avatar')->default('user.jpg');
             $table->string('division')->nullable();
             $table->string('job')->nullable();
             $table->string('additional_email')->nullable();
             $table->string('phone')->nullable();
             $table->string('additional_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
