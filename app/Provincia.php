<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
        'id',
        'depa_id',
        'nombre',
        'observacion',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    public function localidades()
    {
        return $this->hasMany('App\Localidad');
    }
}
