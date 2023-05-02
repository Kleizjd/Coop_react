<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice_Tercero extends Model
{
    use HasFactory;

    protected $table = 'indice_tercero';
    protected $filliable = [
        'id_ind_sec', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado', 'created_at'
    ];

    public $timestamps = false;
}
