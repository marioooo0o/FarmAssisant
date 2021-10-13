<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('farms')->insert([
            'name' => "Farma",
            'street' => "Miejska", 
            'street_number'=> 54,
            'postal_code' => '65-001',
            'city' => 'Szczecin',
        ]);
    }
}
