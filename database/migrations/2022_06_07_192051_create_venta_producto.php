<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_producto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_venta')->unsigned();
        //    $table->foreign('id_venta')->references('id')->on('venta');
            $table->bigInteger('id_producto')->unsigned();
         //   $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('cantidad');
            $table->double('total');
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
        Schema::dropIfExists('venta_producto');
    }
}
