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
        'id_gran_unidad',
        'id_fuerza',
        'peq_unidad',
        'abreviatura',
        'descripcion',
        'lat',
        'lng',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];
}
