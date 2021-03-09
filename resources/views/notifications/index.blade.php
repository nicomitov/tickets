@extends('layouts.app')

@section('page_title')
    @lang('Notifications')
@endsection

@section('page_title_description')

@endsection

@section('page_buttons')
    @include('notifications.page_buttons')
@endsection

@section('content')

<span class="items-list-page">
@if($notifications->count() > 0)
<div class="card items">
    <ul class="item-list striped">
        {{-- header row --}}
        <li class="item item-list-header">
            <div class="item-row">
                <div class="item-col item-col-header">
                    <div>
                        <span>Latest</span>
                    </div>
                </div>

                <div class="item-col item-col-header fixed item-col-actions-dropdown">
                </div>
            </div>
        </li>
        @foreach($notifications as $notification)
        {{-- list row --}}
        <li class="item">
            <div class="item-row {{ is_null($notification->read_at) ? 'alert-warning' : '' }}">
                {{-- image --}}
                <div class="item-col fixed item-col-img xs" style="height: 40px; flex-basis: 40px;">
                    <div class="item-img rounded ull-left" style="background-image: url({{ $notification->data['image'] }})">
                        {{-- @if(is_null($notification->data['image']))
                        {!! Avatar::create($notification->data['author'])->toSvg() !!}
                        @endif --}}
                    </div>
                </div>

                {{-- subject --}}
                <div class="item-col fixed item-col-title ml-0">
                    <div>
                            <h4 class="item-title">
                                <a href="{{ route('users.index') }}" class="font-weight-bold d-inline">{{ $notification->data['author'] }}</a>

                                <span class="text-muted"> {{ $notification->data['action'] }} </span>

                                <a href="{{ route('notifications.show', $notification) }}" class="d-inline">
                                {{ $notification->data['subject'] }}
                                </a>
                                <span class="text-muted">on {{ $notification->data['date'] }}</span>
                            </h4>

                    </div>
                </div>

                {{-- actions --}}
                <div class="item-col fixed item-col-actions-dropdown m-0">
                    <div class="item-actions-dropdown">
                        <a class="item-actions-toggle-btn">
                            <span class="inactive">
                                <i class="fas fa-cog"></i>
                            </span>
                            <span class="active">
                                <i class="fas fa-chevron-circle-right"></i>
                            </span>
                        </a>
                        <div class="item-actions-block">
                            <ul class="item-actions-list">
                                <li>

                                    {{ Form::open(['method' => 'DELETE', 'class' => 'd-inline form-delete', 'route' => ['notifications.destroy', $notification->id ]]) }}
                                    <button type="submit" class="remove" data-toggle="modal" data-target="#confirm" role="button" title="Delete" data-rel="tooltip">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    {{ Form::close() }}
                                </li>
                                <li>
                                    {{ Form::open(['method' => 'DELETE', 'class' => 'd-inline', 'route' => ['notifications.read', $notification->id ]]) }}
                                    <button type="submit" class="remove" role="button" title="Mark as read" data-rel="tooltip">
                                        <i class="far fa-eye text-info"></i>
                                    </button>
                                    {{ Form::close() }}

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </li>
        @endforeach
    </ul>
</div>
@else
    @include('partials.noentries')
@endif

{{-- @include('partials.delete_modal', ['text' => 'This will delete all your notifications! Are you sure you, want to delete?']) --}}

</span>

<div class="pull-right">
    {{ $notifications->links() }}
</div>

<div class="pagination-info">
    Notifications: {{ $notifications->firstItem() }}-{{ $notifications->lastItem() }} of {{ $notifications->total() }}
</div>

@endsection
