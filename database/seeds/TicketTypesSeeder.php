<?php

use Illuminate\Database\Seeder;

class TicketTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_types')->insert(['name' => 'Сообщение об ошибке']);
        DB::table('ticket_types')->insert(['name' => 'Предложение по улучшению']);
    }
}
