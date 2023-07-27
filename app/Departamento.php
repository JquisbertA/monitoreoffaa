<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    protected $fillable = [
        'id',
        'nombre',
        'abreviatura',
        'observacion',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];

    public function provincia()
    {
        return $this->hasMany('App\Provincia');
    }
}
