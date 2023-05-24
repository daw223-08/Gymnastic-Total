<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cantidad', 'familia', 'horario_ingesta', 'dia', 'kcal', 'id_usuario'];

    public function dietas()
    {
        return $this->belongsToMany(Dieta::class, 'dieta__alimentos', 'id_alimento', 'id_dieta');
    }

}