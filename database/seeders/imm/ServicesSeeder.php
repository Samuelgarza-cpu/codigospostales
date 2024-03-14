<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Educación",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Bolsa de Empleo",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>" Procesos de Formación",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Vivienda",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Proyectos Productivos",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Canalización",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Capacitación para el trabajo",
            'created_at' => now()
           ]);
            DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Salud",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Servicios de Prevención de violencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Cursos y Talleres",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Trabajo Social",
            'created_at' => now()
           ]);   DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Psicología",
            'created_at' => now()
           ]);   DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Trámites y Gestiones",
            'created_at' => now()
           ]);   DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Pláticas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Otros",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('services')->insert([
            "service"=>"Vinculación",
            'created_at' => now()
           ]);
    }
}
