<?php

namespace App\Policies;

use App\TicketStatus;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any ticket statuses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('ticket-statuses');
    }

    /**
     * Determine whether the user can view the ticket status.
     *
     * @param  \App\User  $user
     * @param  \App\TicketStatus  $ticketStatus
     * @return mixed
     */
    public function view(User $user, TicketStatus $ticketStatus)
    {
        //
    }

    /**
     * Determine whether the user can create ticket statuses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('ticket-statuses');
    }

    /**
     * Determine whether the user can update the ticket status.
     *
     * @param  \App\User  $user
     * @param  \App\TicketStatus  $ticketStatus
     * @return mixed
     */
    public function update(User $user, TicketStatus $ticketStatus)
    {
        return $user->hasRole('ticket-statuses');
    }

    /**
     * Determine whether the user can delete the ticket status.
     *
     * @param  \App\User  $user
     * @param  \App\TicketStatus  $ticketStatus
     * @return mixed
     */
    public function delete(User $user, TicketStatus $ticketStatus)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the ticket status.
     *
     * @param  \App\User  $user
     * @param  \App\TicketStatus  $ticketStatus
     * @return mixed
     */
    public function restore(User $user, TicketStatus $ticketStatus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket status.
     *
     * @param  \App\User  $user
     * @param  \App\TicketStatus  $ticketStatus
     * @return mixed
     */
    public function forceDelete(User $user, TicketStatus $ticketStatus)
    {
        //
    }
}
