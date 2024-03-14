<?php

namespace Database\Seeders\Imm;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class LowEffectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Alcohol",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Marihuana",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Ansiolítico",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Drogas sintéticas",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Otro",
            'created_at' => now()
           ]);
           DB::connection("mysql_imm")->table('loweffects')->insert([
            "loweffect"=>"Ninguno",
            'created_at' => now()
           ]);

    }
}
