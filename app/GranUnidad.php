<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GranUnidad extends Model
{
    //
    protected $table = 'gran_unidads';

    protected $fillable = [
        'id',
        'ceo_id',
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
