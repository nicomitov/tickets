<?php

namespace App\Policies;

use App\TicketCategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any ticket categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('ticket-categories');
    }

    /**
     * Determine whether the user can view the ticket category.
     *
     * @param  \App\User  $user
     * @param  \App\TicketCategory  $ticketCategory
     * @return mixed
     */
    public function view(User $user, TicketCategory $ticketCategory)
    {
        //
    }

    /**
     * Determine whether the user can create ticket categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('ticket-categories');
    }

    /**
     * Determine whether the user can update the ticket category.
     *
     * @param  \App\User  $user
     * @param  \App\TicketCategory  $ticketCategory
     * @return mixed
     */
    public function update(User $user, TicketCategory $ticketCategory)
    {
        return $user->hasRole('ticket-categories');
    }

    /**
     * Determine whether the user can delete the ticket category.
     *
     * @param  \App\User  $user
     * @param  \App\TicketCategory  $ticketCategory
     * @return mixed
     */
    public function delete(User $user, TicketCategory $ticketCategory)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the ticket category.
     *
     * @param  \App\User  $user
     * @param  \App\TicketCategory  $ticketCategory
     * @return mixed
     */
    public function restore(User $user, TicketCategory $ticketCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket category.
     *
     * @param  \App\User  $user
     * @param  \App\TicketCategory  $ticketCategory
     * @return mixed
     */
    public function forceDelete(User $user, TicketCategory $ticketCategory)
    {
        //
    }
}
