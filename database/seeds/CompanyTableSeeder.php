<?php

use Illuminate\Database\Seeder;
use App\Model\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i=0; $i < 100; $i++){
            Company::create([
                'name' => 'name '. $i,
                'address' => 'address' . $i,
                'website' => 'website' . $i
            ]);
        }
    }
}
