<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasa_Otros extends Model
{
    protected $table = 'tasa_otros';

	protected $fillable = ['id','tasa','estatus'];
}
