<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MedicalservicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Gobierno estatal",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Seguro privado",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"SECMAR",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"IMSS",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Becas para el bienestar",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Otro",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"ISSSTE",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"PEMEX",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Ninguno",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"Seguro Popular",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('medicalservices')->insert([
            "medicalservice"=>"SEDENA",
            'created_at' => now()
           ]);
    }
}
