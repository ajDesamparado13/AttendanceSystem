<?php

use App\Entities\User;
use App\Entities\Role;
use App\Entities\Menu;
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
        $user = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::where('id', $user->id)->first();
        $user->roles()->attach($user->id, [
            'user_id' => $user->id,
            'role_id' => 1,
        ]);

        $role = Role::where('id', 1)->first();

        $menus = Menu::all();
        foreach($menus as $menu){
            $role->menus()->attach($role->id, [
                'role_id' => $role->id,
                'menu_id' => $menu->id
            ]);
        }
        
    }
}