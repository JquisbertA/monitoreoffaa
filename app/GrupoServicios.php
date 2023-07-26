<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoServicios extends Model
{
    //
    protected $table = 'grupo_servicios';

    protected $fillable = [
        'id',
        'descripcion',
        'observaciones',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];

}
