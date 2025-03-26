<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grado';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_fuerza', 'grado', 'abreviatura', 'estado'];
}
