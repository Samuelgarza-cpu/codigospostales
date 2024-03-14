<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class WorkplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Calle-Via publica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Casa ajena",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Campo",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Fabrica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Taller",
            'created_at' => now()
           ]);  
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Empresa/Negocio",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Casa Propia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Comercio",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Institución",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('workplaces')->insert([
            "workplace"=>"Escuela",
            'created_at' => now()
           ]);

    }
}
