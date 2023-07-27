<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'id',
        'prov_id',
        'nombre',
        'observacion',
        'estado',
        'sysuser',
        'created_at',
        'updated_at'
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }
}
