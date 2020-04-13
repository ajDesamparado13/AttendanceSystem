<?php

use App\Entities\Employee;
use App\Entities\Menu;
use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::where('id', $user->id)->first();
        $user->roles()->attach($user->id, [
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

        Employee::create([
            'user_id' => $user->id,
            'firstname' => $faker->firstName($gender = null),
            'lastname' => $faker->lastName,
            'phone' => $faker->phoneNumber,
        ]);

        $user = User::create([
            'email' => 'bobby.gerez@yahoo.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::where('id', $user->id)->first();
        $user->roles()->attach($user->id, [
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

        Employee::create([
            'user_id' => $user->id,
            'firstname' => $faker->firstName($gender = null),
            'lastname' => $faker->lastName,
            'phone' => $faker->phoneNumber,
        ]);

        $role = Role::where('id', 1)->first();

        $menus = Menu::all();
        foreach ($menus as $menu) {
            $role->menus()->attach($role->id, [
                'role_id' => $role->id,
                'menu_id' => $menu->id,
            ]);
        }

        $role = Role::where('id', 2)->first();
        $menu = Menu::where('name', 'Timelogs')->first();
        $role->menus()->attach($role->id, [
            'role_id' => $role->id,
            'menu_id' => $menu->id,
        ]);

        $menu = Menu::where('name', 'My Machine')->first();
        $role->menus()->attach($role->id, [
            'role_id' => $role->id,
            'menu_id' => $menu->id,
        ]);

        $menu = Menu::where('name', 'Profile')->first();
        $role->menus()->attach($role->id, [
            'role_id' => $role->id,
            'menu_id' => $menu->id,
        ]);

    }
}