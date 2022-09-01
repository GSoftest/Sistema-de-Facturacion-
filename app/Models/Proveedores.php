<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{

    protected $table = 'providers';

	protected $fillable = ['name','email','phone_number','status'];
    

}
