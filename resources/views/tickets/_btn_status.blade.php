<div class="dropdown">
    <a class="text-light badge badge-{{ $ticket->getStatusClass() }} badge-pill dropdown-toggle px-2 py-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $ticket->status->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        @foreach(App\TicketStatus::pluck('name', 'id') as $status)
        <a class="dropdown-item py-2 @cannot('update', $ticket) disabled @endcan" href="{{ route('tickets.status_change', [$ticket, $status]) }}">{{ $status }}</a>
        @endforeach
    </div>
</div>
