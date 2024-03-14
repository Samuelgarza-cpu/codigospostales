<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class AxisProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>1,
            "axisprogram"=>"1.-Desarrollo de Instrumentos Normativos",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>1,
            "axisprogram"=>"2.-Fortalecimiento del Instituto Municipal de la Mujer",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>1,
            "axisprogram"=>"3.-Géstion Pública con Perspectiva de Género.",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>2,
            "axisprogram"=>"1.-Educación para Todas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>2,
            "axisprogram"=>"2.-Mujeres Emprendedoras",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>2,
            "axisprogram"=>"3.-Reconocimiento del Trabajo Domestico y corresponsabilidad familiar.",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>3,
            "axisprogram"=>"1.-Derechos de las Mujeres",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>3,
            "axisprogram"=>"2.-Fechas Conmemorativas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('axisprograms')->insert([
            "id_axi"=>3,
            "axisprogram"=>"3.-Prevención de la Violencia contra las Mujeres",
            'created_at' => now()
           ]);
    }
}
