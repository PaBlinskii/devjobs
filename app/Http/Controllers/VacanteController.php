<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // como no toma ninguna instancia en este caso colocamos el modelo vacante
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // vamos a impedir que el usuario pueda crear vacantes excepto el reclutador
        $this->authorize('create', Vacante::class);
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //
        return view('vacantes.show', [
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        // Autorizando la edición por medio de Policy
        $this->authorize('update', $vacante);

        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }

    // Quitamos mostrar, update y destroy porque livewire ya lo esta manejando
}
