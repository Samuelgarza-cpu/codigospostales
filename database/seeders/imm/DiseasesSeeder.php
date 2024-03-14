<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DiseasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Crónico/Degenerativa",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Ginecológicas unirarias",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Gastrointestinales",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Respiratorias",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Osteovascular",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Infecciosas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Neuropsiquiátricas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('diseases')->insert([
            "diseas"=>"Cardiovasculares",
            'created_at' => now()
           ]);

    }
}
