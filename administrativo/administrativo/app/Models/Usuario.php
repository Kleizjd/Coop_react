<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'usuario';
    protected $filliable = [
        'cedula', 'nombre', 'contrasena'
    ];

    public $timestamps = false;
}
