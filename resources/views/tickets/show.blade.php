@extends('layouts.app')

@section('page_title')
    @lang('Tickets')
@endsection

@section('page_buttons')
    @include('tickets._btn_page')
@endsection

@section('filter')
    @include('tickets._filter')
@endsection

@section('content')

    <div class="card">
        <div class="card-header card-header-sm bordered">
            <div class="header-block w-100">
                {{-- name --}}
                <p class="title">
                    {{ mb_strtoupper(str_limit($ticket->name, 100), "utf-8") }}
                </p>

                {{-- status --}}
                <div class="dropdown pull-right">
                    <a class="text-light badge badge-{{ $ticket->getStatusClass() }} badge-pill dropdown-toggle px-2 py-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $ticket->status->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        @foreach($statuses as $status)
                        <a class="dropdown-item py-2" href="{{ route('tickets.status_change', [$ticket->id, $status]) }}">{{ $status }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- details --}}
                <div class="title-description">
                    <span class="ticket_details">
                        <i class="far fa-calendar text-primary"></i> {{ $ticket->created_at->format('j-M-Y, H:i') }}
                    </span>
                    <span class="ticket_details">
                        <i class="far fa-user text-primary"></i> {!! $ticket->employeesList() !!}
                    </span>
                    @isset ($ticket->device)
                        <span class="ticket_details">
                            <i class="fas fa-desktop text-primary"></i>
                            #<a href="{{ route('devices.show', $ticket->device) }}">{{ $ticket->device->inv }}</a>
                        </span>
                    @endisset
                    <span class="ticket_details">
                        <i class="far fa-flag text-primary"></i> {{ $ticket->priority->name }}
                    </span>
                    <span class="ticket_details">
                        <i class="far fa-folder text-primary"></i> {{ $ticket->category->name }}
                    </span>
                </div>
            </div>
        </div>
        <div class="card-block dont-break-out">

            <div>{!! $ticket->description !!}</div>

            {{-- <div id="printableArea" class="d-none d-print-inline" style="padding:40px;">
                {!! wordwrap($ticket->description, 140, "\r\n") !!}
            </div> --}}
        </div>

        <div class="card-footer">
            <details>
                <summary>history</summary>
                <p class="small pl-3">
                @foreach($ticket->users as $user)
                    {{ $user->pivot->created_at->format('j-M-Y, H:m') }} -
                    <a href="{{ route('tickets.user', $user) }}" data-rel="tooltip" title="{{ $user->name . '\'s tickets' }}">
                        {{ $user->name }}
                    </a> -
                    {!! $user->pivot->action !!}
                    <br>
                @endforeach
                </p>
            </details>
        </div>
    </div>
@endsection
