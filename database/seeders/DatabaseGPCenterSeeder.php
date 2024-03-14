<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseGPCenterSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GPCenter\MenuSeeder::class,
            GPCenter\RoleSeeder::class,
            GPCenter\DepartamentSeeder::class,
            GPCenter\BrandSeeder::class,
            GPCenter\ModelSeeder::class,
            GPCenter\VehicleStatusSeeder::class,
            GPCenter\UserSeeder::class,
       
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
