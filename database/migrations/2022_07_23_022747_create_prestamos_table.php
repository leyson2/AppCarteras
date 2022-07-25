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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->decimal('montoprestamo', 10, 2)->comment('Monto del préstamo');
            $table->integer('interes')->comment('Interés del préstamo');
            $table->integer('nmeses')->comment('Número de meses del préstamo');
            $table->decimal('montopagar', 12, 2)->comment('Monto a pagar');
            $table->date('fecha_inicio')->comment('Fecha de fin del préstamo');
            $table->date('fecha_fin')->nullable()->comment('Fecha de fin del préstamo');
            $table->date('proximo_pago')->comment('Fecha del próximo pago');
            $table->enum('estado', ['Pendiente', 'Pagado', 'Aprobado', 'No Aprobado'])->default('Pendiente')->comment('Estado del préstamo');
            $table->unsignedBigInteger('cliente_id')->comment('Cliente del préstamo');
            $table->timestamps();

            // Relación con la tabla clientes
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
};
