<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporalVentaProducto extends Model
{
    protected $table = 'temporal_venta_producto';

    protected $fillable = [
        'id',
        'id_venta',
        'id_producto',
        'cantidad',
        'total',
        ];
    
}