<?php

namespace App\Policies;

use App\TicketPriority;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPriorityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any ticket priorities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('ticket-priorities');
    }

    /**
     * Determine whether the user can view the ticket priority.
     *
     * @param  \App\User  $user
     * @param  \App\TicketPriority  $ticketPriority
     * @return mixed
     */
    public function view(User $user, TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Determine whether the user can create ticket priorities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('ticket-priorities');
    }

    /**
     * Determine whether the user can update the ticket priority.
     *
     * @param  \App\User  $user
     * @param  \App\TicketPriority  $ticketPriority
     * @return mixed
     */
    public function update(User $user, TicketPriority $ticketPriority)
    {
        return $user->hasRole('ticket-priorities');
    }

    /**
     * Determine whether the user can delete the ticket priority.
     *
     * @param  \App\User  $user
     * @param  \App\TicketPriority  $ticketPriority
     * @return mixed
     */
    public function delete(User $user, TicketPriority $ticketPriority)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the ticket priority.
     *
     * @param  \App\User  $user
     * @param  \App\TicketPriority  $ticketPriority
     * @return mixed
     */
    public function restore(User $user, TicketPriority $ticketPriority)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket priority.
     *
     * @param  \App\User  $user
     * @param  \App\TicketPriority  $ticketPriority
     * @return mixed
     */
    public function forceDelete(User $user, TicketPriority $ticketPriority)
    {
        //
    }
}
