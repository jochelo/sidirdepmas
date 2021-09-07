<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('latitud', 10, 7)->nullable();
            $table->float('longitud', 10, 7)->nullable();
            $table->boolean('activo');
            $table->unsignedBigInteger('municipio_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('departamento_id');

            $table->foreign('municipio_id')->references('id')->on('municipios')->cascadeOnDelete();
            $table->foreign('provincia_id')->references('id')->on('provincias')->cascadeOnDelete();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->cascadeOnDelete();

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
        Schema::dropIfExists('localidads');
    }
}
