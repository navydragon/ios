<?php

use Illuminate\Database\Seeder;

class ProjectStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_statuses')->insert(['name' => 'Подготовка']);
        DB::table('project_statuses')->insert(['name' => 'Активна']);
        DB::table('project_statuses')->insert(['name' => 'Отменена']);
        DB::table('project_statuses')->insert(['name' => 'Завершена']);
    }
}
