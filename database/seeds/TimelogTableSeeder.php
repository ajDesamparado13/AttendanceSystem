<?php

use App\Entities\Timelog;
use Illuminate\Database\Seeder;

class TimelogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 5; $i++) {
            Timelog::create([
                'causerable_type' => 'App\Entities\User',
                'causerable_id' => $i + 1,
                'action' => 'time-in',
            ]);
        }
    }
}