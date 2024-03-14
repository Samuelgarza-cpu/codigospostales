<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseImmSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            imm\Gender::class,
            imm\CivilStatusSeeder::class,
            imm\ActivitiesSeeder::class,
            imm\WorkplaceSeeder::class,
            imm\MedicalservicesSeeder::class,
            imm\TrainingSeeder::class,
            imm\DiseasesSeeder::class,
            imm\OriginsSeeder::class,
            imm\DisabilitiesSeeder::class,
            imm\HouseholdsSeeder::class,
            imm\AddictionsSeeder::class,
            imm\TypeViolenceSeeder::class,
            imm\FieldViolenceSeeder::class,
            imm\LowEffectSeeder::class,
            imm\ServicesSeeder::class,
            imm\AxisSeeder::class,
            imm\AxisProgramSeeder::class,
            imm\StatusSeeder::class,
            imm\ProblematicSeeder::class,
            imm\ClosuremotifSeeder::class,
            imm\ExpendentMotiveClosedSeeder::class,
            imm\ExpendentProblemsSeeder::class,
            imm\ExpendentTypeViolenceSeeder::class,


        ]);
       
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}