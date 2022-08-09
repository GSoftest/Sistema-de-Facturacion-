<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{

    protected $table = 'venta';

	protected $fillable = ['id','id_cliente','sub_total','iva','total','fecha'];
    

}