<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoServicios extends Model
{
    //
    protected $table = 'modos_pago_servicios';

    protected $fillable = [
        'id',
        'descripcion',
        'codigo',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];
}
