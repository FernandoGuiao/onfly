<?php

namespace App\Policies;

use App\Http\Requests\StoreDespesaRequest;
use App\Models\Despesa;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DespesaPolicy
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
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para visualizar essa despesa.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, StoreDespesaRequest $request)
    {
        return $user->id === $request->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para criar essa despesa.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para editar esta despesa.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Você não tem permissão para deletar esta despesa.');
    }

}
