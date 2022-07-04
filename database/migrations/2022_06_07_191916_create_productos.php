<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_categoria')->unsigned();
        //    $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->bigInteger('id_iva')->unsigned();
        //    $table->foreign('id_iva')->references('id')->on('procentaje_impuesto');
            $table->string('name');
            $table->double('precio_sin_iva');
            $table->double('costo_unitario');
            $table->integer('contenido_neto');
            $table->integer('unidad');
            $table->double('peso');
            $table->double('altura');
            $table->double('ancho');
            $table->double('longitud');
            $table->string('description');
            $table->integer('upc');
            $table->integer('imagen_url');
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
        Schema::dropIfExists('productos');
    }
}
