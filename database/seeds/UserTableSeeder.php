<?php

use App\Model\User;
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
    }
}
