<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaMovimientoSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_movimiento_socials', function (Blueprint $table) {
            $table->id();

            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('movimiento_social_id');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();
            $table->foreign('movimiento_social_id')->references('id')->on('movimiento_socials')->cascadeOnDelete();

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
        Schema::dropIfExists('persona_movimiento_socials');
    }
}
