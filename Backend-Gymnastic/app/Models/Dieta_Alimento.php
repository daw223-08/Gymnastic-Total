<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta_Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['id_dieta', 'id_alimento', 'id_usuario'];
}