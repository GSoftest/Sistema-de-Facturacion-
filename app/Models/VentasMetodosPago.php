<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasMetodosPago extends Model
{
    protected $table = 'venta_metodo_pago';

    protected $fillable = [
        'id',
        'id_venta',
        'id_metodo_pago',
        'monto_pago',
        ];
    
}