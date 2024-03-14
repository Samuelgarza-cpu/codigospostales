<?php

namespace Database\Seeders\GPCenter;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_gp_center')->table('departments')->insert([
            'department' => 'No Aplica',
            'description' => 'Para asignar a usuarios administrativos.',
            'created_at' => now(),
        ]);
    }
}
