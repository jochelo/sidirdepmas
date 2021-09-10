<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaCircunscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_circunscripcions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_final')->nullable();
            $table->boolean('activo')->default(true);
            $table->string('direccion')->nullable();


            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('circunscripcion_id');
            $table->unsignedBigInteger('localidad_id');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();
            $table->foreign('circunscripcion_id')->references('id')->on('circunscripcions')->cascadeOnDelete();
            $table->foreign('localidad_id')->references('id')->on('localidads')->cascadeOnDelete();

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
        Schema::dropIfExists('persona_circunscripcions');
    }
}
