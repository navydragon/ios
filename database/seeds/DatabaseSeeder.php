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
    }
}
