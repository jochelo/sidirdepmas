<?php

namespace Database\Seeders;

use App\Models\Circunscripcion;
use App\Models\Evento;
use App\Models\EventoCongresoParticipante;
use App\Models\Rol;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        Rol::create([
            'nombre' => 'Consultor',
            'descripcion' => 'Persona que solo consulta la lista de inscritos'
        ]);

        Rol::create([
            'nombre' => 'Verificador',
            'descripcion' => 'Persona verifica, valida y depura registros'
        ]);

        User::create([
            'cuenta' => 'root23',
            'email' => 'root@dirdepor.com',
            'password' => Hash::make('root1010'),
            'rol_id' => 1,
            'confirmed' => 1
        ]);

        User::create([
            'cuenta' => 'verificador',
            'email' => 'verificador@dirdepor.com',
            'password' => Hash::make('verificador1010'),
            'rol_id' => 7,
            'confirmed' => 1
        ]);

        User::create([
            'cuenta' => 'consultor',
            'email' => 'consultor@dirdepor.com',
            'password' => Hash::make('consultor1010'),
            'rol_id' => 6,
            'confirmed' => 1
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
            LocalidadesSeeder::class,
            PermisoSeeder::class
        ]);

        Ubicacion::create([
            'latitud' => -19.013097780164156,
            'longitud' => -68.37282611707032,
            'lugar' => 'SABAYA',
            'localidad_id' => 154,
        ]);

        $evento = Evento::create([
            'lugar' => 'Municipio de sabaya',
            'fecha_inicial' => '2021-09-11',
            'fecha_final' => '2021-09-12',
            'tipo' => 'congreso',
            'nombre' => '9º CONGRESO DEPARTAMENTAL ORDINARIO DEL MAS-IPSP ORURO',
            'descripcion' => '9no CONGRESO DEPARTAMENTAL ORDINARIO DEL MOVIMIENTO AL SOCIALISMO - INSTRUMENTO POLITICO POR LA SOBERANIA DE LOS PUEBLOS, ORURO',
            'ubicacion_id' => 1,
        ]);
        for ( $i = 1; $i <= 4; $i++) {
            EventoCongresoParticipante::create([
                'cupo_varon' => 100,
                'cupo_mujer' => 100,
                'equidad' => true,
                'cupo_adscritos_varon' => 50,
                'cupo_adscritos_mujer' => 50,
                'adscritos' => true,
                'circunscripcion_id' => $i,
                'evento_id' => $evento['id'],
            ]);
        }
    }
}
