<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas_Productos extends Model
{

    protected $table = 'venta_producto';

	protected $fillable = ['id','id_venta','id_producto','cantidad','total'];
    

}