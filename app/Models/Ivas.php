<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ivas extends Model
{

    protected $table = 'porcentaje_impuesto';

	protected $fillable = ['id','iva','estado'];
    

}
