<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GranUnidad extends Model
{
    //
    protected $table = 'gran_unidads';

    protected $fillable = [
        'id',
        'id_fuerza',
        'gran_unidad',
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
