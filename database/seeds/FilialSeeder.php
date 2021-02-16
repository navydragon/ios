<?php

use Illuminate\Database\Seeder;

class FilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filials')->insert(['name' => 'Российский университет транспорта',
        'shortname' => 'РУТ (МИИТ)',]);
        DB::table('filials')->insert(['name' => 'Департамент охраны труда, промышленной безопасности и экологического контроля',
        'shortname' => 'ЦБТ',]);
        DB::table('filials')->insert(['name' => 'Октябрьская железная дорога','shortname' => 'ОКТ',]);
        DB::table('filials')->insert(['name' => 'Калининградская железная дорога','shortname' => 'КЛНГ',]);
        DB::table('filials')->insert(['name' => 'Московская железная дорога','shortname' => 'МСК',]);
        DB::table('filials')->insert(['name' => 'Горьковская железная дорога','shortname' => 'ГОРЬК',]);
        DB::table('filials')->insert(['name' => 'Северная железная дорога','shortname' => 'СЕВ',]);
        DB::table('filials')->insert(['name' => 'Северо-Кавказская железная дорога','shortname' => 'С-КАВ',]);
        DB::table('filials')->insert(['name' => 'Юго-Восточная железная дорога','shortname' => 'Ю-ВОСТ',]);
        DB::table('filials')->insert(['name' => 'Приволжская железная дорога','shortname' => 'ПРИВ',]);
        DB::table('filials')->insert(['name' => 'Куйбышевская железная дорога','shortname' => 'КБШ',]);
        DB::table('filials')->insert(['name' => 'Свердловская железная дорога','shortname' => 'СВЕРД',]);
        DB::table('filials')->insert(['name' => 'Южно-Уральская железная дорога','shortname' => 'Ю-УР',]);
        DB::table('filials')->insert(['name' => 'Западно-Сибирская железная дорога','shortname' => 'З-СИБ',]);
        DB::table('filials')->insert(['name' => 'Красноярская железная дорога','shortname' => 'КРАС',]);
        DB::table('filials')->insert(['name' => 'Восточно-Сибирская железная дорога','shortname' => 'В-СИБ',]);
        DB::table('filials')->insert(['name' => 'Забайкальская железная дорога','shortname' => 'ЗАБ',]);
        DB::table('filials')->insert(['name' => 'Дальневосточная железная дорога','shortname' => 'ДВОСТ',]);
    }
}
