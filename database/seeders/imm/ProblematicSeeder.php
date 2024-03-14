<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ProblematicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Abuso sexual durante su niñez",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Duelo",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Depresión",
            'created_at' => now()
           ]);   
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Autoestima/ Autocuidado",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Codependencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Ideación Suicida",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Intento de suicidio",
            'created_at' => now()
           ]);
             DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Adicciones",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Estrés Post traumático",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Ansiedad",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('problematics')->insert([
            "problem"=>"Otro: Especifique.",
            'created_at' => now()
           ]);
    }
}
