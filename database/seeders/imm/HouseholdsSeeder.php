<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class HouseholdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('households')->insert([
            "household"=>"Comodato(Prestada)",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('households')->insert([
            "household"=>"Propia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('households')->insert([
            "household"=>"Rentada",
            'created_at' => now()
           ]);

    }
}
