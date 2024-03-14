<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('levels')->insert([ 
            'level' => 'PRIMARIA', 
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('levels')->insert([ 
            'level' => 'SECUNDARIA', 
            'created_at' => now(),
        ]);
    }
}