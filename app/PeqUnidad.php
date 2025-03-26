<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeqUnidad extends Model
{
    //
    //
    protected $table = 'peq_unidads';

    protected $fillable = [
        'id',
        'gu_id',
        'nombre',
        'abreviatura',
        'descripcion',
        'coordenadas',
        'lat',
        'lng',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];
}
