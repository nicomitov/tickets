<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Thread' => 'App\Policies\ThreadPolicy',
        'App\Entry' => 'App\Policies\EntryPolicy',
        'App\Log' => 'App\Policies\LogPolicy',
        'App\Check' => 'App\Policies\CheckPolicy',
        'App\Checkitem' => 'App\Policies\CheckitemPolicy',
        'App\Page' => 'App\Policies\PagePolicy',
        'App\Menu' => 'App\Policies\MenuPolicy',
        'App\Ticket' => 'App\Policies\TicketPolicy',
        'App\TicketPriority' => 'App\Policies\TicketPriorityPolicy',
        'App\TicketStatus' => 'App\Policies\TicketStatusPolicy',
        'App\TicketCategory' => 'App\Policies\TicketCategoryPolicy',
        'App\Device' => 'App\Policies\DevicePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
