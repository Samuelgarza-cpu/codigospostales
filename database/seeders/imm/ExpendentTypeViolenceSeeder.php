<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExpendentTypeViolenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia física",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia psicológica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia económica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia patrimonial",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia sexual",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Violencia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Digital/Cibernética",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_type_violences')->insert([
            "type_violence"=>"Sin violencia",
            'created_at' => now()
           ]);
    }
}
