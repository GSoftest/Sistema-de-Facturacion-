<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    protected $table = 'medida_unidad';

	protected $fillable = ['id','unidad'];
}
