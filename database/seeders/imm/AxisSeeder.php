<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AxisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('axis')->insert([
            "axi"=>"1.- Institucionalización de la Perspectiva de Género",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axis')->insert([
            "axi"=>"2.- Agencia económica para las Mujeres",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axis')->insert([
            "axi"=>"3.- Agenda de Género para la Igualdad",
            'created_at' => now()
           ]);
    }
}
