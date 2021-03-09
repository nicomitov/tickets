@extends('layouts.app')

@section('page_title')
    @lang('Employees')
@endsection

@section('page_buttons')
    @include('users.btn_page')
@endsection

@section('filter')
@endsection

@section('content')

    <section class="section dashboard-page mb-1">
        <div class="row">
            <div class="col-md-6 col-xl-4 col-xxl-3 offset-md-3 offset-xl-4 offset-xxl-0 stats-col">
                <div class="card sameheight-item stats pt-3" data-exclude="xs">
                    <div class="text-center">
                        <div class="card-body">
                            {{-- avatar --}}
                            <img src="{{ $user->getAvatarThumb() }}" class="img-fluid rounded-circle img-thumbnail" style="width: 120px;">
                        </div>

                        {{-- dept --}}
                        <div class="card-body pt-0">
                            <h6 class="card-title font-weight-bold">{{ $user->name }}</h6>
                            <h6 class="card-subtitle text-muted">
                                {{ $user->department->name }}
                            </h6>
                        </div>

                        {{-- details --}}
                        <div class="card-body text-left">
                            <div class="row">
                                <div class="col text-muted font-weight-light">E-mail:</div>
                                <div class="col text-right"><a class="text-decoration-none" href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="col text-muted font-weight-light">Work Phone:</div>
                                <div class="col text-right">{{ $user->work_phone }}</div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="col text-muted font-weight-light">Mobile Phone:</div>
                                <div class="col text-right"><a class="text-decoration-none" href="tel:{{ $user->mobile_phone }}">{{ $user->mobile_phone }}</a></div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="col text-muted font-weight-light">Position:</div>
                                <div class="col text-right">{{ $user->position }}</div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="col text-muted font-weight-light">Joined:</div>
                                <div class="col text-right">{{ $user->created_at->format('j-M-Y') }}</div>
                            </div>
                            <hr class="my-2">

                            @can('viewAny', App\Role::class)
                            <div class="row">
                                <div class="col text-muted font-weight-light">Permissions:</div>
                                <div class="col text-right"><span class="text-primary small" style="cursor:pointer" data-toggle="popover" title="Site Modules:" data-content="@foreach($user->roles as $role) {{ $role->name }}</br> @endforeach" data-placement="top" data-html="true" data-target="#info-{{ $user->id }}">Show <i class="fas fa-external-link-alt"></i></span></div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            {{-- tickets --}}
            <div class="col-xl-12 col-xxl-9">
                <div class="row">
                    <div class="col-12 stats-col">
                        <div class="card ">
                            <div class="card-header card-header-sm bordered">
                                <div class="header-block">
                                    <h3 class="title"> @lang('Ticket List') </h3>
                                </div>
                                <div class="header-block pull-right">
                                    <a href="{{ route('tickets.employee', $user) }}" class="btn btn-primary-outline btn-sm rounded pull-right @cannot('viewAny', App\Ticket::class) disabled @endcan"> View All </a>
                                </div>
                            </div>
                            @can('viewAny', App\Ticket::class)
                                @if($user->causedTickets->count() > 0)
                                    @include('tickets._list', [
                                        'tickets' => $user->causedTickets->sortByDesc('created_at')
                                    ])
                                @else
                                    <div class="m-4">
                                    @include('partials.noentries')
                                    </div>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

@endsection
