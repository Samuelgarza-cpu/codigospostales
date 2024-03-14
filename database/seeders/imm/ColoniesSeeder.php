<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColoniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('colonies')->insert([
            "municipality_id"=>1,
            "state_id"=>1,
            "colony"=>"Masculino",
            "cp"=>"Masculino",
            "zone"=>"Masculino",
            'created_at' => now()
           ]);
    }
}
