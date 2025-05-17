<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarefaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Tarefa $tarefa)
    {
        return $user->id === $tarefa->autor_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function delete(User $user, Tarefa $tarefa)
    {
        return $user->id == $tarefa->autor_id;
    }

    public function restore(User $user, Tarefa $tarefa)
    {
        return false;
    }

    public function forceDelete(User $user, Tarefa $tarefa)
    {
        return false;
    }
}
