<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporalVenta extends Model
{
    protected $table = 'temporal_venta';

    protected $fillable = [
        'id',
        'id_cliente',
        'subtotal',
        'iva',
        'total',
        ];
    
}