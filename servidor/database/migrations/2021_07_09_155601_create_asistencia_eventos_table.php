<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_eventos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('observacion');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('ambiente_evento_id');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();
            $table->foreign('ambiente_evento_id')->references('id')->on('ambiente_eventos')->cascadeOnDelete();

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
        Schema::dropIfExists('asistencia_eventos');
    }
}
