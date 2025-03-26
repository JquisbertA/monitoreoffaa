<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    protected $table = 'arma';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_fuerza', 'arma', 'abreviatura', 'estado'];
}
