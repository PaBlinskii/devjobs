<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    // Este componente es el padre de FiltrarVacantes
    // Declaramos variables para que no aparezca error en render y buscar

    public $termino;
    public $categoria;
    public $salario;

    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public function buscar($termino, $categoria, $salario)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;

    }

    public function render()
    {
        // $vacantes = Vacante::all();

        // Metodo para buscar avanzado, laravel implemento when para estas consultas
        // When se ejecuta unicamente si las variables de funcion buscar tienen algo
        // ahora se convierte en un callback se pasa en automatico como primer parametro el query actual y a ese query le agregamos where
        // Ejemplo de busqueda = "React Developer"
        // Cuando el % en lado derecho = Solo va encontrar que inicien con el termino "React"
        // Cuando el % en lado izquierdo = Solo va encontrar que finalicen con el termino  "React" 
        // Cuando el % esta en ambos lados = Solo va encontrar donde quiera que se encuentre"React" 
        $vacantes = Vacante::when($this->termino, function($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })
        // orWhere define que lo va buscar por el termino de titulo y sino encuentra lo busca por empresa
        ->when($this->termino, function($query) {
            $query->orWhere('empresa', 'LIKE', "%" . $this->termino . "%");
        })
        // Categoria_id si tiene que ser exactamente igual al registro de la BD
        ->when($this->categoria, function($query) {
            $query->where('categoria_id', $this->categoria);
        })
        ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->paginate(10);

        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
