<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class FieldViolenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"En la comunidad",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Familiar",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Institucional",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Laboral",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Escolar/Docente",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Obstétrica",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Política",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Digital/Cibernética",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('fieldsviolences')->insert([
            "fieldviolence"=>"Feminicida",
            'created_at' => now()
           ]);
    }
}
