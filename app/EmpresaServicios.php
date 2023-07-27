<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaServicios extends Model
{
    //
    protected $table = 'empresa_servicios';

    protected $fillable = [
        'id',
        'sigla',
        'descripcion',
        'codigo',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];
}
