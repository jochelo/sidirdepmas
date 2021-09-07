<?php

namespace Database\Seeders;

use App\Models\Circunscripcion;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Rol::create([
           'nombre' => 'Administrador',
           'descripcion' => 'Administrador general del sistema'
        ]);

        Rol::create([
            'nombre' => 'Militante',
            'descripcion' => 'Persona militante del partido'
        ]);

        Rol::create([
            'nombre' => 'Encargado Provincia',
            'descripcion' => 'Persona militante encargado de provincia'
        ]);

        Rol::create([
            'nombre' => 'Encargado Circunscripcion',
            'descripcion' => 'Persona militante encargado de circunscripcion'
        ]);

        Rol::create([
            'nombre' => 'Encargado Departamental',
            'descripcion' => 'Persona militante encargado departamental'
        ]);

        Circunscripcion::create([
            'codigo' => 'C-29',
            'descripcion' => '',
            'codigo_anterior' => ''
        ]);
        Circunscripcion::create([
            'codigo' => 'C-30',
            'descripcion' => '',
            'codigo_anterior' => ''
        ]);
        Circunscripcion::create([
            'codigo' => 'C-31',
            'descripcion' => '',
            'codigo_anterior' => ''
        ]);
        Circunscripcion::create([
            'codigo' => 'C-32',
            'descripcion' => '',
            'codigo_anterior' => ''
        ]);

        $this->call([
            LugaresSeeder::class,
            MunicipiosSeeder::class,
            LocalidadesSeeder::class
        ]);
    }
}
