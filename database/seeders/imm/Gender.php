<?php

namespace Database\Seeders\imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Gender extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::connection("mysql_imm")->table('genders')->insert([
        "gender"=>"Femenino",
        'created_at' => now()
       ]);
     
       DB::connection("mysql_imm")->table('genders')->insert([
        "gender"=>"Masculino",
        'created_at' => now()
       ]);
       DB::connection("mysql_imm")->table('genders')->insert([
        "gender"=>"Lesbico",
        'created_at' => now()
       ]);
       DB::connection("mysql_imm")->table('genders')->insert([
        "gender"=>"Gay",
        'created_at' => now()
       ]);
       DB::connection("mysql_imm")->table('genders')->insert([
        "gender"=>"Trans",
        'created_at' => now()
       ]);
    }
}
