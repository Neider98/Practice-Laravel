<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id')
                ->comment('id');
            $table->string('numero_factura', 200)
                ->comment('Numero de la factura')->unique();
            $table->timestamp('fecha_generacion')
                ->comment('Fecha y hora de la generacion de la factura');
            $table->string('emisor', 100)
                ->comment('Nombre y NIT del emisor de la factura');
            $table->string('receptor', 100)
                ->comment('Nombre y NIT de comprador');
            $table->integer('subtotal')
                ->comment('Valor neto antes de aplicar costo de IVA');
            $table->integer('IVA')
                ->comment('Valor del IVA');
            $table->integer('Total')
                ->comment('Total a pagar') ;
            $table->string('items_facturados')
                ->comment('Descripcion del item, Cantidad, Valor unitario,
                    Valor total');
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
        Schema::dropIfExists('invoices');
    }
}
