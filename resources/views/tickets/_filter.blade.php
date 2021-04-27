<div class="ml-xl-4 filter">

    <div class="card">
        <a class="title d-block d-xl-none list-group-item border-0 px-2 click" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
            Filter <span class="pull-right"><i class="fas fa-chevron-right"></i></span>
        </a>

        <div class="list-group-flush condensed collapse show" id="collapse">
            {{-- my --}}
            <a href="{{ route('tickets.user', auth()->user()) }}" class="list-group-item {{ isActiveRoute('tickets.user') }}">
                <i class="far fa-heart fa-lg fa-fw text-primary"></i> My tickets <span class="badge badge-light badge-pill pull-right">{{ count(auth()->user()->uniqueTickets()) }}</span>
            </a>
            <a class="list-group-item divider"></a>

            {{-- ststus --}}
            @foreach(App\TicketStatus::all() as $status)
            <a href="{{ route('tickets.status', $status) }}" class="list-group-item {{ isActiveMatch($status->name) }}">
                <i class="far fa-circle fa-lg fa-fw text-primary"></i> {{ $status->name }} <span class="badge badge-light badge-pill pull-right">{{ $status->tickets->count() }}</span>
            </a>
            @endforeach

            <a class="list-group-item divider"></a>

            {{-- priority --}}
            @foreach(App\TicketPriority::all() as $priority)
            <a href="{{ route('tickets.priority', $priority) }}" class="list-group-item {{ isActiveMatch($priority->name) }}">
                <i class="far fa-flag fa-lg fa-fw text-primary"></i> {{ $priority->name }} <span class="badge badge-light badge-pill pull-right">{{ $priority->tickets->count() }}</span>
            </a>
            @endforeach

            <a class="list-group-item divider"></a>

            {{-- category --}}
            @foreach(App\TicketCategory::all() as $category)
            <a href="{{ route('tickets.category', $category) }}" class="list-group-item {{ isActiveMatch($category->name) }}">
                <i class="far fa-folder fa-lg fa-fw text-primary"></i> {{ $category->name }} <span class="badge badge-light badge-pill pull-right">{{ $category->tickets->count() }}</span>
            </a>
            @endforeach
        </div>
    </div>

</div>
