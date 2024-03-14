<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class OriginsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Enfermedad",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Edad avanzada",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Nació asi",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Accidente",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Violencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('origins')->insert([
            "origin"=>"Otra causa",
            'created_at' => now()
           ]);
    }
}
