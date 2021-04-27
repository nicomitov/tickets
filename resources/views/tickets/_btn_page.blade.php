{{-- add new --}}
{{-- @if (Route::CurrentRouteName() != 'tickets.create')
    <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm @cannot('create', App\Ticket::class) disabled @endcan">
        <i class="fas fa-plus"></i> Add New
    </a>
@endif --}}

<div class="action dropdown">
    <button class="btn btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        More actions...
    </button>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">

        @if (Route::CurrentRouteName() == 'tickets.edit')
            {{-- delete --}}
            @include('partials.btn_delete_modal', ['model' => $ticket, 'route' => 'tickets.destroy', 'btn_class' => 'dropdown-item', 'title' => 'Delete ticket', 'permission' => ['delete', $ticket]])
            <div class="dropdown-divider"></div>
        @endif

        @if (Route::CurrentRouteName() == 'tickets.show')
            <a class="dropdown-item text-decoration-none @cannot('update', $ticket) disabled @endcan" href="{{ route('tickets.edit', $ticket) }}">
                <i class="far fa-edit icon"></i> Edit ticket
            </a>

            @include('partials.btn_delete_modal', ['model' => $ticket, 'route' => 'tickets.destroy', 'btn_class' => 'dropdown-item', 'title' => 'Delete ticket', 'permission' => ['delete', $ticket]])
            <div class="dropdown-divider"></div>
        @endif

        <a class="dropdown-item text-decoration-none @cannot('viewAny', App\TicketStatus::class) disabled @endcan" href="{{ route('tickets.statuses.index') }}">
            <i class="fas fa-cog icon"></i> Edit statuses
        </a>
        <a class="dropdown-item text-decoration-none @cannot('viewAny', App\TicketPriority::class) disabled @endcan" href="{{ route('tickets.priorities.index') }}">
            <i class="fas fa-cog icon"></i> Edit priorities
        </a>
        <a class="dropdown-item text-decoration-none @cannot('viewAny', App\TicketCategory::class) disabled @endcan" href="{{ route('tickets.categories.index') }}">
            <i class="fas fa-cog icon"></i> Edit categories
        </a>

    </div>
</div>
