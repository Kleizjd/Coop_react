<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice_Cuarto extends Model
{
    use HasFactory;

    protected $table = 'indice_cuarto';
    protected $filliable = [
        'id_ind_ter', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado', 'created_at'
    ];

    public $timestamps = false;
}
