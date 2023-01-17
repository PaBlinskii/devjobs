<?php

namespace App\Models;

use App\Models\User;
use App\Models\Salario;
use App\Models\Candidato;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vacante extends Model
{
    use HasFactory;

    protected $dates = ['ultimo_dia'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Le vamos a decir a este modelo que pertenece a otro modelo también
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    // Una Vacante tiene muchos candidatos
    public function candidatos()
    {
        // Ordenando notificación más reciente con el orderBy
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    // Aca nos salimos de las conveniencias de Laravel ya que reclutador no existe sino el usuario
    // Una relación uno a uno donde una vacante pertenece a un usuario y hay que especificar el user_id
    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
