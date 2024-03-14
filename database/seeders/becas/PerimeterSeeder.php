<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PerimeterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('perimeters')->insert([ 
            'perimeter' => 'NO ASIGNADO', 
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('perimeters')->insert([ 
            'perimeter' => 'CENTRO', 
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('perimeters')->insert([ 
            'perimeter' => 'LAVIN', 
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('perimeters')->insert([ 
            'perimeter' => 'SACRAMENTO', 
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('perimeters')->insert([ 
            'perimeter' => 'URBANO', 
            'created_at' => now(),
        ]);
    }
}