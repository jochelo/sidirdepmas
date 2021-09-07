<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Provincia;
use Illuminate\Database\Seeder;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
            'sigla' => 'OR',
            'nombre' => 'ORURO',
            'orden' => 4,
        ]);
        Departamento::create([
            'sigla' => 'LP',
            'nombre' => 'LA PAZ',
            'orden' => 1,
        ]);
        Departamento::create([
            'sigla' => 'PT',
            'nombre' => 'POTOSI',
            'orden' => 7,
        ]);
        Departamento::create([
            'sigla' => 'CO',
            'nombre' => 'COCHABAMBA',
            'orden' => 2,
        ]);
        Departamento::create([
            'sigla' => 'CH',
            'nombre' => 'CHUQUISACA',
            'orden' => 5,
        ]);
        Departamento::create([
            'sigla' => 'TA',
            'nombre' => 'TARIJA',
            'orden' => 6,
        ]);
        Departamento::create([
            'sigla' => 'PA',
            'nombre' => 'PANDO',
            'orden' => 8,
        ]);
        Departamento::create([
            'sigla' => 'BE',
            'nombre' => 'BENI',
            'orden' => 9,
        ]);
        Departamento::create([
            'sigla' => 'SC',
            'nombre' => 'SANTA CRUZ',
            'orden' => 3,
        ]);


        /**
         * PROVINCIAS
        */

        Provincia::create([
            'nombre' => 'AVAROA',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'CARANGAS',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'CERCADO',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'LADISLAO CABRERA',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'LITORAL',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'MEJILLONES',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'NOR CARANGAS',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'PANTALEON DALENCE',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'POOPO',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SABAYA',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SAJAMA',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SAN PEDRO DE TOTORA',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SAUCARI',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SEBASTIAN PAGADOR',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'SUD CARANGAS',
            'departamento_id' => 1
        ]);

        Provincia::create([
            'nombre' => 'TOMAS BARRON',
            'departamento_id' => 1
        ]);
        Provincia::create([
            'nombre' => 'PEDRO DOMINGO MURILLO',
            'departamento_id' => 1
        ]);
    }
}
