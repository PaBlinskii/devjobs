<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacantePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // Especificamos que solo el usuario con rol 2 puede acceder a las vacantes publicadas
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // Permite solo al Reclutador crear Vacantes
        return $user->rol === 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Vacante $vacante)
    {
        // Si el usuario esta editando la vacante es igual al user id de la vacante, se permite editar
        // Solo el usuario que creo la vacante puede verla y editarla
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vacante $vacante)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vacante $vacante)
    {
        //
    }
}
