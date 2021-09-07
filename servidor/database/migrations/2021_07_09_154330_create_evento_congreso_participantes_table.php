<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoCongresoParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_congreso_participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cupo_varon');
            $table->unsignedInteger('cupo_mujer');
            $table->boolean('equidad');
            $table->unsignedInteger('cupo_adscritos_varon');
            $table->unsignedInteger('cupo_adscritos_mujer');
            $table->boolean('adscritos');

            $table->unsignedBigInteger('circunscripcion_id');
            $table->unsignedBigInteger('evento_id');

            $table->foreign('circunscripcion_id')->references('id')->on('circunscripcions')->cascadeOnDelete();
            $table->foreign('evento_id')->references('id')->on('eventos')->cascadeOnDelete();

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
        Schema::dropIfExists('evento_congreso_participantes');
    }
}
