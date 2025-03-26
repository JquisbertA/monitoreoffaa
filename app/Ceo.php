<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ceo extends Model
{
    //
    protected $table = 'ceo';

    protected $fillable = [
        'id',
        'nombre',
        'sigla',
        'descripcion',
        'region',
        'coordenadas',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];
}
