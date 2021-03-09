<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <a href="/">
                    {{-- <img src="/images/logo.svg" style="width:126px;"> --}}
                    <h2 class="text-muted font-weight-bold pt-3">TICKETS</h2>
                </a>
            </div>
        </div>
        <nav class="menu">
            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                {{-- DASHBOARD --}}
                <li class="{{ isActiveRoute('home') }}">
                    <a href="/">
                        <i class="fas fa-tachometer-alt fa-fw"></i> @lang('Dashboard')
                    </a>
                </li>

                {{-- TICKETS --}}
                @can('viewAny', App\Ticket::class)
                <li class="{{ isActiveRoute(['tickets.index', 'tickets.create', 'tickets.show', 'tickets.edit']) }}">
                    <a href="{{ route('tickets.index') }}">
                        <i class="far fa-list-alt fa-fw"></i> @lang('Tickets')
                    </a>
                </li>
                @endcan

                {{-- STATUSES --}}
                @can('viewAny', App\TicketStatus::class)
                <li class="{{ isActiveRoute('tickets.statuses.*') }}">
                    <a href="{{ route('tickets.statuses.index') }}">
                        <i class="far fa-list-alt fa-fw"></i> @lang('Ticket Statuses')
                    </a>
                </li>
                @endcan

                {{-- CATEGORIES --}}
                @can('viewAny', App\TicketCategory::class)
                <li class="{{ isActiveRoute('tickets.categories.*') }}">
                    <a href="{{ route('tickets.categories.index') }}">
                        <i class="far fa-list-alt fa-fw"></i> @lang('Ticket Categories')
                    </a>
                </li>
                @endcan

                {{-- PRIORITIES --}}
                @can('viewAny', App\TicketPriority::class)
                <li class="{{ isActiveRoute('tickets.priorities.*') }}">
                    <a href="{{ route('tickets.priorities.index') }}">
                        <i class="far fa-list-alt fa-fw"></i> @lang('Ticket Priorities')
                    </a>
                </li>
                @endcan

                {{-- DEPARTMENTS --}}
                @can('viewAny', App\Department::class)
                <li class="{{ isActiveRoute(['departments.*']) }}">
                    <a href="{{ route('departments.index') }}">
                        <i class="fas fa-laptop-house fa-fw"></i> @lang('Departments')
                    </a>
                </li>
                @endcan

                {{-- EMPLOYEES --}}
                @can('viewAny', App\User::class)
                <li class="{{ isActiveRoute(['users.*']) }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-user-tie fa-fw"></i> @lang('Employees')
                    </a>
                </li>
                @endcan

                {{-- ROLES --}}
                @can('viewAny', App\Role::class)
                <li class="{{ isActiveRoute(['roles.*']) }}">
                    <a href="{{ route('roles.index') }}">
                        <i class="fas fa-cog fa-fw"></i> @lang('Modules')
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebar-overlay"></div>
<div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
<div class="mobile-menu-handle"></div>
