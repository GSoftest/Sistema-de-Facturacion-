<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio_Tecnico extends Model
{

    protected $table = 'servicio_tecnicos';

	protected $fillable = [
        'id',
        'recibo',
        'id_cliente',
        'id_iva',
        'descripcion_equipo',
        'fecha',
        'monto_sin_iva',
        'monto_con_iva',
        'abono',
        'monto_pendiente'];
    

}