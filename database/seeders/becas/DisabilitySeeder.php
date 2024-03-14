<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('disabilities')->insert([
            'disability' => 'SIN DISCAPACIDAD',
            // 'description' => '',
            'created_at' => now(),
        ]);
    }
}
