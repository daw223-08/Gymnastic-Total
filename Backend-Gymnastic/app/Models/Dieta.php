<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alimento;

class Dieta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'descripcion', 'id_usuario'];

    public function alimentos()
    {
        return $this->belongsToMany(Alimento::class, 'dieta__alimentos', 'id_dieta', 'id_alimento');
    }
}