<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Ninguno. No sabe Leer/Escribir",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Ninguno. Sabe Leer/Escribir",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Preescolar",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Primaria",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Secundaria",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Preparatoria",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Comercio/Técnica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Lic.",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Maestria",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"Doctorado",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('trainings')->insert([
            "training"=>"No estudio",
            'created_at' => now()
           ]);
    }
}
