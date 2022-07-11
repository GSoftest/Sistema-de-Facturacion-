<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

    protected $table = 'cliente';

	protected $fillable = ['name','identificacion','telefono','direccion','correo'];
    

}