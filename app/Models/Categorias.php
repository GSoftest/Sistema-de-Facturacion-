<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{

    protected $table = 'categorias';

	protected $fillable = ['name','descripcion'];
    

}