<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';

    protected $fillable = [
        'id_venta',
        'numero_factura',
        'url_factura',
        ];
    
}