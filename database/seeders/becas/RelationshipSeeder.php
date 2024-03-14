<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'MADRE',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'PADRE',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'ABUELA',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'ABUELO',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'TIO',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('relationships')->insert([
            'relationship' => 'TIA',
            'created_at' => now(),
        ]);
    }
}
