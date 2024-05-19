<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create a ticket.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->type === 'Colaborador';
    }
}
