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

        for ($i = 0; $i < 10; $i++) {
            Timelog::create([
                'causer_type' => 'App\Entities\User',
                'causer_id' => $i + 1,
                'action' => 'time-in',
            ]);
        }
    }
}