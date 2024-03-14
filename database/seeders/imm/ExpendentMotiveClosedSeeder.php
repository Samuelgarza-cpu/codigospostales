<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExpendentMotiveClosedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('expendent_motive_closeds')->insert([
            "motive_closed"=>"1.-Conclusión De Proceso",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_motive_closeds')->insert([
            "motive_closed"=>"2.-Usuaria Ya No Acudió",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_motive_closeds')->insert([
            "motive_closed"=>"3.-Usuaria Referenciada A Otra Instancia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('expendent_motive_closeds')->insert([
            "motive_closed"=>"4.-Otro",
            'created_at' => now()
           ]);
         
    }
}
