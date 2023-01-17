<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vacante_id',
        'cv'
    ];

    // Gracias a esta relación se puede mostrar los candidatos en la vista
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
