<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    // Para pasar parametros de sweetAlert desde el controlador
    // protected $listeners = ['prueba'];

    // public function prueba($vacante_id)
    // {
    //     dd($vacante_id);
    // }
    // Declaramos la funcion en el array
    protected $listeners = ['eliminarVacante'];

    public function eliminarVacante(Vacante $vacante)
    {
        $vacante->delete();
    }
    
    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}


// Tambien se puede de esta manera...

    // return view('livewire.mostrar-vacantes', [
    //     'vacantes' => Vacante::where('user_id', auth()->user()->id)->paginate(10);
    // ]);