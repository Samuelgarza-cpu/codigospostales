<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ClosuremotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('closuremotifs')->insert([
            "motive"=>"1.-Conclusión De Proceso",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('closuremotifs')->insert([
            "motive"=>"2.-Usuaria Ya No Acudió",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('closuremotifs')->insert([
            "motive"=>"3.-Usuaria Referenciada A Otra Instancia",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('closuremotifs')->insert([
            "motive"=>"4.-Otro",
            'created_at' => now()
           ]);
    }
}
