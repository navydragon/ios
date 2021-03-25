<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FilialSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ProjectStatusesSeeder::class);
        $this->call(KnBaseCategorySeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CompetenceSeeder::class);
        $this->call(EventTypesSeeder::class);
        $this->call(ForumsSeeder::class);
        $this->call(ProjectRolesSeeder::class);
        $this->call(QuestionTypesSeeder::class);
        $this->call(TicketTypesSeeder::class);
    }
}
