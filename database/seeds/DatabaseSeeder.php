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
        $this->call(PostTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(EmployeeTableSeeder::class);
    }
}