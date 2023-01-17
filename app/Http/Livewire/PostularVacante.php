<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\NuevoCandidato;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        // Almacenar el CV
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // Crear el Candidato a la Vacante
        // No colocamos vacante en el array porque Laravel ya sabe gracias a la relación HasMany en el modelo Vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear notificación y enviar el email
        // Accedemos a toda la instancia del usuario
        // Importante pasarle los valores a nuevo candidato
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

        // Mostrar el usuario un mensaje de ok
        session()->flash('mensaje', 'Se envió correctamente tu información, mucha suerte');

        return redirect()->back();
        
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
