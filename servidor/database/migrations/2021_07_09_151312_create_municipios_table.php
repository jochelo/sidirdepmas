<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('latitud', 10, 7)->nullable()->default(null);
            $table->float('longitud', 10, 7)->nullable()->default(null);
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('circunscripcion_id');

            $table->foreign('provincia_id')->references('id')->on('provincias')->cascadeOnDelete();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->cascadeOnDelete();
            $table->foreign('circunscripcion_id')->references('id')->on('circunscripcions')->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
