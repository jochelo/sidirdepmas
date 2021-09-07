<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuellasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huellas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dedo');
            $table->string('nombre_dedo');
            $table->string('codigo_huella');
            $table->unsignedBigInteger('persona_id');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();

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
        Schema::dropIfExists('huellas');
    }
}
