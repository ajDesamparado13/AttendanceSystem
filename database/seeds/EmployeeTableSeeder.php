<?php

use App\Model\Employee;
use App\Model\User;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'email' => $faker->safeEmail,
                'password' => Hash::make(str_random(6)),
            ]);
            $user = User::where('id', $user->id)->first();
            $user->roles()->attach($user->id, [
                'user_id' => $user->id,
                'role_id' => 2,
            ]);
            Employee::create([
                'user_id' => $user->id,
                'firstname' => $faker->firstName($gender = null),
                'lastname' => $faker->lastName,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}