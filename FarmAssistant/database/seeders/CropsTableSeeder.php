<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crops')->insert([
            'name' => "Wiśnia",
        ]);

        DB::table('crops')->insert([
            'name' => "Porzeczka czarna",
        ]);

        DB::table('crops')->insert([
            'name' => "Pszenica ozima",
        ]);
    }
}
