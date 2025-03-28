<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    

    //use HasFactory;

    protected $table = 'incidentes';



    protected $fillable = [
       'id_incidente', 'tipo', 'descripcion', 'id_ceo', 'fecha_hora', 'coordenadas_incidente', 'estado'
    ];

    // public function ceo()
    // {
    //     return $this->belongsTo(Ceo::class, 'ID_CEO');
    // }



}
