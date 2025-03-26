<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personal';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_fuerza', 'id_escalafon', 'id_grado', 'id_especialidad', 'id_arma', 'nombre', 'ap_paterno', 'ap_materno', 'ci', 'cm'];
}
