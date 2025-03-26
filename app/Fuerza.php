<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuerza extends Model
{
    protected $table = 'fuerza';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'fuerza', 'abreviatura', 'estado'];
}
