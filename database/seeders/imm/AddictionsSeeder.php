<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AddictionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Alcohol",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Marihuana",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Ansiolitico",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Drogas sintéticas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Otro",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('addictions')->insert([
            "addiction"=>"Ninguna",
            'created_at' => now()
           ]);

           
    }
}
