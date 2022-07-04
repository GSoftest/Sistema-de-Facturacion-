<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibo';

    protected $fillable = [
        'id',
        'recibo',
        'pdf',
        ];
    
}