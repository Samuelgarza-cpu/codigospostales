<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Estudia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Jubilada/Pensionada",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Trabaja en el hogar",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Trabaja fuera del hogar",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Se desconoce",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Otro",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Actividad ilicita",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Agricola/Artesanal",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Autoempleo",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Auxiliar/Técnica",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Actividad/doméstica",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Vigilancia/Seguridad",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Chofer/Taxista",
            'created_at' => now()
           ]); DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Comerciante",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Dirección/Jefatura",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Docencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Profesionista",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Empleado(a)",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Funcionaria(o) Publico",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('activities')->insert([
            "activity"=>"Desempleado",
            'created_at' => now()
           ]);

    }
}
