<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indice_Quinto extends Model
{
    use HasFactory;

    protected $table = 'indice_quinto';
    protected $filliable = [
        'id_ind_cua', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado', 'created_at'
    ];

    public $timestamps = false;
}
