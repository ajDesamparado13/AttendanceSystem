<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ['Admin', 'Employees'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}
