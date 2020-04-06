<?php

use Illuminate\Database\Seeder;
use App\Entities\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            'Users', 'Roles', 'Employees', 'Machines', 'Timelogs'
        ];

        foreach($menus as $menu){
            Menu::create([
                'name' => $menu
            ]);
        }
    }
}