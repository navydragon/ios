<?php

use Illuminate\Database\Seeder;

class ForumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forums')->insert(['name' => 'ОБЩИЙ ФОРУМ','access_level' => 0, 'visible' => 1]);
    }
}
