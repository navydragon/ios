<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Пользователь с ролью Администратор',
            'email'=> 'admin1@test.ru',
            'password' =>  Hash::make('111111'),
            'filial_id' => 2,
            'lastname' => 'Пользователь',
            'firstname' => 'с ролью',
            'middlename' => 'Администратор',
            'role_id' => 1
            ]);
 
        DB::table('users')->insert([
            'name' => 'Пользователь с ролью Администратор филиала',
            'email'=> 'admin2@test.ru',
            'password' =>  Hash::make('222222'),
            'filial_id' => 2,
            'lastname' => 'Пользователь',
            'firstname' => 'с ролью',
            'middlename' => 'Администратор филиала',
            'role_id' => 2
            ]);
        DB::table('users')->insert([
            'name' => 'Обычный пользователь системы',
            'email'=> 'user@test.ru',
            'password' =>  Hash::make('333333'),
            'filial_id' => 2,
            'lastname' => 'Обычный',
            'firstname' => 'пользователь',
            'middlename' => 'системы',
            'role_id' => 3
            ]);
    }
}
