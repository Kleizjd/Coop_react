<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice_Secundario extends Model
{
    use HasFactory;

    protected $table = 'indice_secundario';
    protected $filliable = [
        'id_ind_pri', 'consecutivo', 'tipo', 'titulo', 'contenido', 'usuario', 'estado', 'created_at'
    ];

    public $timestamps = false;
}
