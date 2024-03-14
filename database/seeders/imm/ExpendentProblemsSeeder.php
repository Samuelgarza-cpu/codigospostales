<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ExpendentProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Abuso sexual durante su niñez",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Duelo",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Depresión",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Autoestima/ Autocuidado",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Codependencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Ideación Suicida",
            'created_at' => now()
           ]);  
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Intento de suicidio",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Adicciones",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Estrés Post traumático",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_problems')->insert([
            "problem"=>"Ansiedad",
            'created_at' => now()
           ]);
    }
}
