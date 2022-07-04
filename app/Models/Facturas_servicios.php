<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas_servicios extends Model
{
    protected $table = 'factura_servicios';

    protected $fillable = [
        'id',
        'numero_factura',
        'pdf',
        ];
    
}