<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\RolPermiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permiso::create([
            'a' => '1',
            'b' => '0',
            'c' => '0',
            'd' => '0',
            'e' => '0',
            'alias' => 'Menu Izquierda',
            'descripcion' => 'Visualización del menu en la parte izquierda',
            'url' => 'menu-izq',
            'habilitado' => true
        ]);

        Permiso::create([
            'a' => '1',
            'b' => '1',
            'c' => '0',
            'd' => '0',
            'e' => '0',
            'alias' => 'Dashboard',
            'descripcion' => 'Visualización del modulo de dashboard',
            'url' => 'dashboard',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '0',
            'd' => '0',
            'e' => '0',
            'alias' => 'Eventos',
            'descripcion' => 'Permiso para el nivel de Eventos',
            'url' => 'eventos',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '1',
            'd' => '0',
            'e' => '0',
            'alias' => 'Lista de registro de Eventos',
            'descripcion' => 'permiso para navegar en la lista de Eventos',
            'url' => 'eventos-index',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '0',
            'e' => '0',
            'alias' => 'Validar Inscritos',
            'descripcion' => 'permiso para validar registros de inscritos',
            'url' => 'validar-personas',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '1',
            'e' => '0',
            'alias' => 'Lista de registro de Personas',
            'descripcion' => 'permiso para navegar en la lista de personas del Evento',
            'url' => 'personas-evento-index',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '2',
            'e' => '0',
            'alias' => 'Añadir observacion de registro',
            'descripcion' => 'permiso para Registrar observaciones del registro de la persona',
            'url' => 'personas-evento-create-observacion',
            'habilitado' => true
        ]);

        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '3',
            'e' => '0',
            'alias' => 'Ver observaciones del registro',
            'descripcion' => 'permiso para ver la lista de observaciones del registro de la persona',
            'url' => 'personas-evento-show-observacion',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '4',
            'e' => '0',
            'alias' => 'Aprobar registro',
            'descripcion' => 'permiso para aprobar el registro de la persona',
            'url' => 'personas-evento-aprobar',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '5',
            'e' => '0',
            'alias' => 'Rechazar registro',
            'descripcion' => 'permiso para rechazar el registro de la persona',
            'url' => 'personas-evento-rechazar',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '6',
            'e' => '0',
            'alias' => 'Editar informacion del registro para el evento',
            'descripcion' => 'permiso para editar la información del registro de la persona para el evento',
            'url' => 'personas-evento-editar-info',
            'habilitado' => true
        ]);
        Permiso::create([
            'a' => '1',
            'b' => '2',
            'c' => '2',
            'd' => '7',
            'e' => '0',
            'alias' => 'Imprimir Credencial',
            'descripcion' => 'permiso para imprimir credencial del evento para la persona',
            'url' => 'personas-evento-credencial',
            'habilitado' => true
        ]);

        Permiso::create([
            'a' => '1',
            'b' => '3',
            'c' => '0',
            'd' => '0',
            'e' => '0',
            'alias' => 'Registrar personas',
            'descripcion' => 'permiso para registrar personas',
            'url' => 'store-personas',
            'habilitado' => true
        ]);

        for ($it = 1; $it <= 13; $it++){
            RolPermiso::create([
                'rol_id' => 1,
                'permiso_id' => $it,
            ]);
        }

        // consultor
        for ($it = 1; $it <= 6; $it++){
            RolPermiso::create([
                'rol_id' => 6,
                'permiso_id' => $it,
            ]);
        }
        RolPermiso::create([
            'rol_id' => 6,
            'permiso_id' => 8,
        ]);

        //verificador
        for ($it = 1; $it <= 13; $it++){
            RolPermiso::create([
                'rol_id' => 7,
                'permiso_id' => $it,
            ]);
        }

        //delegados
        RolPermiso::create([
            'rol_id' => 2,
            'permiso_id' => 1,
        ]);
        RolPermiso::create([
            'rol_id' => 2,
            'permiso_id' => 2,
        ]);
    }
}
