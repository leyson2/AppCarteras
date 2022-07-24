<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->decimal('monto', 10, 2)->comment('Monto del abono');
            $table->date('fecha')->comment('Fecha del abono');
            $table->unsignedBigInteger('prestamo_id')->comment('Préstamo del abono');
            $table->timestamps();

            // Relación con la tabla prestamos
            $table->foreign('prestamo_id')->references('id')->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonos');
    }
};
