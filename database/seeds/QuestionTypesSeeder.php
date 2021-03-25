<?php

use Illuminate\Database\Seeder;

class QuestionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->insert(['name' => 'Единичный выбор']);
        DB::table('question_types')->insert(['name' => 'Множественный выбор']);
        DB::table('question_types')->insert(['name' => 'Текстовый ввод']);
    }
}
