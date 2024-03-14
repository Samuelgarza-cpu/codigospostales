<?php

namespace Database\Seeders\Imm;
use DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Casada",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Concubinato",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Soltera",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Viuda",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Union Libre",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Sociedad de convivencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Divorciada",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"Separada",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('civil_status')->insert([
            "civil_status"=>"No indentificada",
            'created_at' => now()
           ]);
    }
}
