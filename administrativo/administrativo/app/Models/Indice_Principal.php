<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice_Principal extends Model
{
    use HasFactory;

    protected $table = 'indice_principal';
    protected $filliable = [
        'año', 'consecutivo', 'titulo', 'usuario', 'estado', 'created_at'
    ];

    public $timestamps = false;
}
