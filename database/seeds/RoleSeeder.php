<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'Администратор']);
        DB::table('roles')->insert(['name' => 'Администратор филиала']);
        DB::table('roles')->insert(['name' => 'Пользователь']);
    }
}
