<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{

    // Variables que capturan la data de los inputs
    public $termino;
    public $categoria;
    public $salario;

    public function leerDatosFormulario()
    {
        $this->emit('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }

    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
    

        return view('livewire.filtrar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
