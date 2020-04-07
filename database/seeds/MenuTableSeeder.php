<?php

use App\Entities\Menu;
use Illuminate\Database\Seeder;

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
            'Users', 'Roles', 'Timelogs',
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu,
            ]);
        }
    }
}