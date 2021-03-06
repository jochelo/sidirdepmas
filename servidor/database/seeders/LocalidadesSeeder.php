<?php

namespace Database\Seeders;

use App\Models\Localidad;
use Illuminate\Database\Seeder;

class LocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombresLocalidades = [
            'CHALLAPATA',
            'CACACHACA',
            'CULTA',
            'CRUCE CULTA',
            'ANCACOTA',
            'HUANCARANI',
            'HUANCANE',
            'THOLA PALCA',
            'CRUCERO',
            'MACHOCA CHURACANI',
            'CENTRAL AGUAS CALIENTES',
            'URU MURATO WILAÑEQUE',
            'URU CAYACHATA',
            'SANTUARIO DE QUILLACAS',
            'SEVARUYO',
            'SORAGA',
            'CORQUE',
            'SAN JOSE DE CALA',
            'OPOQUERI',
            'SAN ANTONIO DE NOR CALA',
            'PACOYO',
            'CARACOTA',
            'JANCOCALA',
            'PAMATA AITE',
            'VILLA ESPERANZA',
            'SAN PEDRO DE HUAYLLOCO',
            'VILLA TARUCACHI',
            'LACA LACA QUITA QUITA',
            'CENTRAL COPACABANA',
            'VILLA NUEVA',
            'ANDAPATA LUPE',
            'HUMAMARCA',
            'CHOQUE COTA',
            'ANDAPATA',
            'ORURO',
            'CARACOLLO',
            'VILLA SANTA FE',
            'VENTILLA PONGO',
            'JANKO UÑO',
            'LA JOYA',
            'VILACARA',
            'SILLOTA VITO',
            'SILLOTA BELEN',
            'LAJMA',
            'KEMALLA',
            'NUEVA LLALLAGUA',
            'SOLEDAD',
            'HUNTUTA',
            'HORENCO',
            'CENTRAL VILA VILA A',
            'CENTRAL  CAÑOHUMA',
            'CONCHA MARCA',
            'SAN ANTONIO DE ANGULO',
            'SAN ANTONIO CRUZANI',
            'ANCOTANGA',
            'EL CHORO',
            'CRUCERO BELEN',
            'CHALLACOLLO',
            'SAN FELIPE DE CHAITIVI',
            'RANCHO GRANDE',
            'SEPULTURAS',
            'PARIA',
            'GUARDAÑA',
            'THOLAPALCA',
            'HUAYÑA PASTO GRANDE',
            'LEQUEPALCA',
            'SORACACHI',
            'IRUMA',
            'CACHI CACHI',
            'CRUCE OCOTAVI',
            'MICAYANI',
            'SAN JUAN PAMPA',
            'BANDERANI',
            'JACHUYO',
            'JATITA',
            'COLLPA',
            'KASA HUASA',
            'CONDORCHINOCA',
            'SALINAS GARCI DE MENDOZA',
            'PUQUI',
            'TAUCA',
            'INEXA',
            'CHALLACOTA',
            'JIRIRA',
            'AROMA',
            'UCUMASI',
            'CONCEPCION DE BELEN',
            'SAN MARTIN',
            'VILLA ESPERANZA',
            'LUCA',
            'PAMPA AULLAGAS',
            'BENGAL VINTO',
            'ICHALULA',
            'HUACHACALLA',
            'ESCARA',
            'PAYRUMANI DEL LITORAL',
            'CRUZ DE MACHACAMARCA',
            'FLORIDA',
            'HUAYLLAS',
            'YUNGUYO DE LITORAL',
            'ESMERALDA',
            'ROMERO PAMPA',
            'PEÑA PEÑANI',
            'BELEN',
            'LA RIVERA',
            'CARANGAS',
            'TODOS SANTOS',
            'SANTIAGO DE HUAYLLAMARCA',
            'ROMERO HUMA',
            'CHUQUICHAMBI',
            'SAN MIGUEL',
            'LLANQUERA',
            'BELEN DE CHOQUECOTA',
            'TUNUPA',
            'BELLA VISTA',
            'CHUJÑOHUMA',
            'PUERTO ÑEQUETA',
            'HUANUNI',
            'CATARICAGUA',
            'MOROCOCALA',
            'NEGRO PABELLON',
            'HUALLATIRI',
            'BOMBO',
            'MACHACAMARCA',
            'SORA SORA',
            'VILLA POOPO',
            'TOLAPAMPA',
            'VENTA Y MEDIA',
            'CORIPATA',
            'PUÑACA',
            'PAZÑA',
            'URMIRI',
            'PEÑAS',
            'TOTORAL',
            'AVICAYA',
            'ANTEQUERA',
            'CHALGUAMAYU',
            'TUTUNI',
            'SABAYA',
            'PACARIZA',
            'PISIGA BOLIVAR SUCRE',
            'JULO',
            'NEGRILLOS',
            'PARAJAYA',
            'BELLA VISTA',
            'MIRAFLORES',
            'SACABAYA',
            'VILLA VITALINA',
            'SAN ANTONIO DE PITACOLLO',
            'QUEA QUEANI',
            'TUNUPA',
            'CRUZ DE HUAYLLAS',
            'VILLA ROSARIO',
            'ALAROCO',
            'PAGADOR',
            'CAHUANA',
            'COIPASA',
            'CHIPAYA',
            'AYPARAVI',
            'VESTRULLANI',
            'CURAHUARA DE CARANGAS',
            'SAJAMA',
            'CARIPE',
            'LAGUNAS',
            'TITIRI',
            'HUAJRIRI',
            'CHACHACOMANI',
            'ASUNCION DE LACA LACA',
            'COSAPA',
            'TURCO',
            'IRUNI',
            'CRUCERO',
            'MACAYA',
            'TOTORA',
            'HUACANAPI',
            'MARQUIRIVI',
            'ROMEROCOTA',
            'CRUCERO',
            'CALAZAYA',
            'CULTA',
            'VINO HUTA',
            'SORA SORA',
            'VILLA IRPOCO',
            'TOLEDO',
            'SAUCARI',
            'CHUQUIÃ‘A',
            'CHALLAVITO',
            'CULLURI',
            'CHOCARASI',
            'CATUYO',
            'UNTAVI',
            'KARI KARI',
            'CHALLA CRUZ',
            'COLLPAHUMA',
            'SICA ULLAMI',
            'KULLURI',
            'CENTRAL JAUSO',
            'TOMA TOMA',
            'TIJLLACAGUA',
            'SANTIAGO DE HUARI',
            'CONDO "C"',
            'CONDO "K"',
            'URMIRI',
            'VICHAJ LUPE',
            'LAGUNILLAS',
            'GUADALUPE',
            'CAICO BOLIVAR',
            'CASTILLAHUMA',
            'CARACOTA',
            'URU URU LLAPA LLAPANI',
            'VILLA VERDE',
            'LUCUMPAYA',
            'ANDAMARCA',
            'ORINOCA',
            'EDUARDO AVAROA',
            'BELEN DE ANDAMARCA',
            'CALAMA HUAYLLAMARCA',
            'REAL MACHACAMARCA',
            'CRUZ DE HUAYLLAMARCA',
            'EUCALIPTUS',
            'AMACHUMA',
            'TARUCAMARCA',
            'ALCAMARCA',
            'HUANCAROMA',
            'QUELCATA',
            'MACHACAMARCA',
            'ÑEQUETA',
            'Chapi',
            'CRUCE VENTILLA',
            'ORURO'
        ];

        $latitudes = [
            -18.90232,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.23229,
            null,
            null,
            -18.350838,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -17.635214,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -17.82263,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.637634,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.396393,
            null,
            null,
            null,
            null,
            -18.793343,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.01573,
            null,
            null,
            -17.83852,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.286015,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.380442,
            null,
            null,
            null,
            null,
            null,
            -19.227444,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.015553,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -17.842802,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.187382,
            null,
            null,
            null,
            -17.793442,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.181274,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.172253,
            null,
            -19.012926,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -18.778725,
            null,
            -18.870161,
            null,
            null,
            null,
            null,
            -17.59567,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -19.069897,
            null
        ];

        $longitud = [
            -66.775154,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -66.94207,
            null,
            null,
            -67.682304,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.20063,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.01807,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.6752,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.282074,
            null,
            null,
            null,
            null,
            -68.262024,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -68.66213,
            null,
            null,
            -67.942696,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -66.83481,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -66.965866,
            null,
            null,
            null,
            null,
            null,
            -66.71943,
            null,
            null,
            null,
            null,
            null,
            null,
            -68.374626,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -68.40886,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -68.17081,
            null,
            null,
            null,
            -68.14606,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.40627,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.40788,
            null,
            -66.77726,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -67.50754,
            null,
            -67.50038,
            null,
            null,
            null,
            null,
            -67.509415,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            -66.20658,
            null
        ];
        $idMunicipio = [
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            2,
            2,
            2,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            4,
            4,
            5,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            6,
            7,
            7,
            7,
            7,
            7,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            10,
            10,
            10,
            11,
            12,
            12,
            13,
            13,
            13,
            14,
            15,
            15,
            15,
            15,
            16,
            17,
            18,
            19,
            19,
            19,
            19,
            19,
            19,
            19,
            19,
            19,
            19,
            20,
            20,
            20,
            20,
            20,
            20,
            21,
            21,
            22,
            22,
            22,
            22,
            22,
            23,
            23,
            23,
            23,
            23,
            24,
            24,
            24,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            25,
            26,
            27,
            27,
            27,
            28,
            28,
            28,
            28,
            29,
            29,
            29,
            29,
            29,
            29,
            29,
            29,
            29,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            31,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            32,
            33,
            33,
            33,
            34,
            34,
            34,
            34,
            35,
            35,
            35,
            35,
            35,
            35,
            35,
            25,
            25,
            1,
            36
        ];

        $idProvincia = [
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            1,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            2,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            3,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            4,
            5,
            5,
            5,
            5,
            5,
            5,
            5,
            5,
            5,
            5,
            5,
            6,
            6,
            6,
            7,
            7,
            7,
            7,
            7,
            7,
            7,
            7,
            7,
            7,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            8,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            9,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            10,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            11,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            12,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            13,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            14,
            15,
            15,
            15,
            15,
            15,
            15,
            15,
            16,
            16,
            16,
            16,
            16,
            16,
            16,
            10,
            10,
            1,
            3
        ];

        for ($i = 0; $i < sizeof($nombresLocalidades); $i++) {
            Localidad::create([
                'nombre' => $nombresLocalidades[$i],
                'latitud' => $latitudes[$i],
                'longitud' => $longitud[$i],
                'activo' => 1,
                'municipio_id' => $idMunicipio[$i],
                'provincia_id' => $idProvincia[$i],
                'departamento_id' => 1,
            ]);
        }
    }
}
