<?php

namespace Database\Seeders\becas;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql_becas')->table('roles')->insert([ 
            'role' => 'SuperAdmin', 
            'description' => 'Rol dedicado para la completa configuraciond del sistema desde el area de desarrollo.', 
            'read' => 'todas', 
            'create' => 'todas', 
            'update' => 'todas', 
            'delete' => 'todas',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('roles')->insert([ 
            'role' => 'Administrador', 
            'description' => 'Rol dedicado para usuarios que gestionaran el sistema.', 
            'read' => 'todas', 
            'create' => 'todas', 
            'update' => 'todas', 
            'delete' => 'todas',
            'created_at' => now(),
        ]);
        DB::connection('mysql_becas')->table('roles')->insert([ 
            'role' => 'Usuario',
            'description' => 'Rol dedicado para usuarios normales.', 
            'created_at' => now(),
        ]);
    }
}