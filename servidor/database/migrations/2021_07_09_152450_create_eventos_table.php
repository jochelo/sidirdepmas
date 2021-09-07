<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('lugar');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->enum('tipo', ['reunion', 'ampliado', 'congreso']);
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('observacion');
            $table->boolean('activo');
            $table->string('archivo_adjunto');

            $table->unsignedBigInteger('ubicacion_id');

            $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->cascadeOnDelete();

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
        Schema::dropIfExists('eventos');
    }
}
