<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseBecasSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            becas\RoleSeeder::class,
            becas\UserSeeder::class,
            becas\PerimeterSeeder::class,
            becas\LevelSeeder::class,
            becas\SchoolSeeder::class,
            becas\DisabilitySeeder::class,
            becas\RelationshipSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}