<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carro extends Model
{
    protected $table = 'carro';
    protected $primaryKey = 'id';
    protected $fillable = [
        'modelo',
        'potencia',
        'ano',
        'torque',
        'combustivel'
    ];
    public $timestamps = false;
}