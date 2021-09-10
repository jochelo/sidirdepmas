<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('observacion')->nullable();
            $table->string('cargo')->nullable();
            $table->boolean('titular')->default(false);
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('evento_id');

            $table->foreign('persona_id')->references('id')->on('personas')->cascadeOnDelete();
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
        Schema::dropIfExists('persona_eventos');
    }
}
