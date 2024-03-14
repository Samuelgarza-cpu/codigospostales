<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeViolenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Económica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Física",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Patrimonial",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"No sufre violencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Psicológica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Sexual",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('typesviolences')->insert([
            "violence"=>"Otro",
            'created_at' => now()
           ]); 
    }
}
