<?php

use Illuminate\Database\Seeder;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->insert(['name' => 'Анкета']);
        DB::table('event_types')->insert(['name' => 'Учебный материал']);
        DB::table('event_types')->insert(['name' => 'Тестирование']);
        DB::table('event_types')->insert(['name' => 'Вебинар']);
        DB::table('event_types')->insert(['name' => 'Задание']);
        DB::table('event_types')->insert(['name' => 'Деловая игра']);
    }
}
