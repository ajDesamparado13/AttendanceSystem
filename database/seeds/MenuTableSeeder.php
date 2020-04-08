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
            'Users', 'My Machine', 'Timelogs',
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu,
            ]);
        }
    }
}