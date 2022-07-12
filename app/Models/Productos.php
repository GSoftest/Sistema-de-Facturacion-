<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{

    protected $table = 'productos';

	protected $fillable = [
        'id',
        'name',
        'precio_sin_iva',
        'costo_unitario',
        'contenido_neto',
        'unidad',
        'altura',
        'ancho',
        'description',
        'upc',
        'id_categoria',
        'exento',
        'imagen_url',
        'id_medida'];
    

        
}
