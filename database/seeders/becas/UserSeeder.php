<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('users')->insert([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'role_id' => 1, //SuperAdmin
            'created_at' => now()
        ]);
    }
}