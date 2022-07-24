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
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->comment('Nombre del cliente');
            $table->string('cedula')->comment('Cédula del cliente');
            $table->string('telefono')->comment('Teléfono del cliente');
            $table->string('direccion')->nullable()->comment('Dirección del cliente');
            $table->string('email')->nullable()->comment('Email del cliente');
            $table->decimal('cupo', 10, 2)->comment('Cupo del cliente');
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
        Schema::dropIfExists('clientes');
    }
};
