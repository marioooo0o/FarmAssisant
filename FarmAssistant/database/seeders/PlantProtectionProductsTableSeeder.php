<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PlantProtectionProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_protection_products')->insert([
            'name' => "Syllit 544 SC",
            'sale_deadline' => "2022-11-30",     
            'term_for_use' => "2023-11-30",      
            'type' => "Fungicyd",            
            'active_substance' => "dodyna - 544 g",
            'plant' => "wiśnia",
            'pest' => "drobna plamistość liści drzew pestkowych",
            'dose' => "Maksymalna/ zalecana dawka dla jednorazowego zastosowania: 1,25 l/ha	zabieg wykonać zapobiegawczo, zgodnie z sygnalizacją lub w momencie wystąpienia pierwszych objawów choroby, od początku fazy kwitnienia do fazy, gdy owoce osiągają 90% typowej wielkości (BBCH 60-79) i/lub po zbiorach",
            'unit' => "l",
            'group_name' => "ROŚLINY SADOWNICZE",   
            'application' => "profesjonalne",
        ]);

        DB::table('plant_protection_products')->insert([
            'name' => "Topsin M 500 SC",
            'sale_deadline' => "2021-08-31",     
            'term_for_use' => "2021-10-19",      
            'type' => "Fungicyd",            
            'active_substance' => "tiofanat metylowy - 500 g",
            'plant' => "marchew",
            'pest' => "alternarioza, szara pleśń, mączniak prawdziwy baldaszkowatych, zgnilizna twardzikowa",
            'dose' => "Maksymalna/zalecana dawka dla jednorazowego zastosowania: 1,2 l/ha. Maksymalna/zalecana dawka dla jednorazowego zastosowania: 12 ml/100m2.",
            'unit' => "l",
            'group_name' => "ROŚLINY WARZYWNE",   
            'application' => "amatorskie / profesjonalne",
        ]);

    }
}
