<?php

use App\Entities\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Post::create([
                'title' => 'title ' . $i,
                'author' => $faker->firstName . ' ' . $faker->lastName
            ]);
        }
    }
}