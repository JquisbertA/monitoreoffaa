<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escalafon extends Model
{
    protected $table = 'escalafon';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'escalafon', 'abreviatura', 'estado'];
}
