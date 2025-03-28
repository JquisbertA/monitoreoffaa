<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidad';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_fuerza', 'especialidad', 'abreviatura', 'estado'];
}
