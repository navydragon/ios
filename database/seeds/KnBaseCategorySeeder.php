<?php

use Illuminate\Database\Seeder;

class KnBaseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('knowledge_categories')->insert(['name' => 'Очная оценочная сессия']);
        DB::table('knowledge_categories')->insert(['name' => 'Лекции']);
        DB::table('knowledge_categories')->insert(['name' => 'Кейсы']);
        DB::table('knowledge_categories')->insert(['name' => 'Нормативные документы']);
        DB::table('knowledge_categories')->insert(['name' => 'Ответы экспертов']);
        DB::table('knowledge_categories')->insert(['name' => 'Тестирования']);
        DB::table('knowledge_categories')->insert(['name' => 'Ответы экспертов']);
        DB::table('knowledge_categories')->insert(['name' => 'Записи вебинаров']);
        DB::table('knowledge_categories')->insert(['name' => 'Заметки']);
        DB::table('knowledge_categories')->insert(['name' => 'Учебные фильмы']);
    }
}
