<?php

use Illuminate\Database\Seeder;

class ProjectRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_roles')->insert(['name' => 'Участник']);
        DB::table('project_roles')->insert(['name' => 'Организатор']);
        DB::table('project_roles')->insert(['name' => 'Эксперт']);
    }
}
