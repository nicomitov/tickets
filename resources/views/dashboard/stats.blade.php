<div class="col-xl-10 mx-auto stats-col">
    <div class="card sameheight-item stats" data-exclude="xs,sm">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h3 class="title">Stats</h3>
            </div>
        </div>
        <div class="card-block">
{{--             <div class="title-block">
                <h4 class="title"> Stats </h4>
                <p class="title-description"> Website metrics for <a href="http://modularteam.github.io/modularity-free-admin-dashboard-theme-html/"> your awesome project </a>
                </p>
            </div> --}}
            <div class="row row-sm stats-container">



                {{-- employees --}}
                @can('viewAny', App\User::class)
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('users.index') }}"><i class="fas fa-user-tie"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value">
                            {{ $employees_count }}
                            <span class="small text-muted"></span>
                        </div>
                        <div class="name"> Employees </div>
                    </div>
                    <div class="progress stat-progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                </div>
                @endcan

                {{-- departments --}}
                @can('viewAny', App\Department::class)
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('departments.index') }}"><i class="fas fa-laptop-house"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value">
                            {{ $departments_count }}
                            <span class="small text-muted"></span>
                        </div>
                        <div class="name"> Departments </div>
                    </div>
                    <div class="progress stat-progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                </div>
                @endcan

                {{-- tickets --}}
                @can('viewAny', App\Ticket::class)
                {{-- all --}}
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('tickets.index') }}"><i class="far fa-list-alt"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value d-inline">
                            {{ $all_tickets->count() }}
                        </div>
                        <div class="name"> Tickets </div>
                    </div>
                    <div class="progress stat-progress">
                        @if($all_tickets->count() > 0)
                        <div class="progress-bar" style="width: {{ $all_tickets->count() * 100 / $all_tickets->count() }}%;"></div>
                        @endif
                    </div>
                </div>

                {{-- pending --}}
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('tickets.status', 'pending') }}"><i class="far fa-list-alt"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value d-inline">
                            {{ $pending_tickets->count() . '/' . $all_tickets->count() }}
                        </div>
                        <sup class="badge badge-secondary">{{ $pending_tickets_perc }}%</sup>
                        <div class="name"> Tickets Pending </div>
                    </div>
                    <div class="progress stat-progress">
                        @if($all_tickets->count() > 0)
                        <div class="progress-bar" style="width: {{ $pending_tickets->count() * 100 / $all_tickets->count() }}%;"></div>
                        @endif
                    </div>
                </div>

                {{-- solved --}}
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('tickets.status', 'solved') }}"><i class="far fa-list-alt"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value d-inline">
                            {{ $solved_tickets->count() . '/' . $all_tickets->count() }}
                        </div>
                        <sup class="badge badge-secondary">{{ $solved_tickets_perc }}%</sup>
                        <div class="name"> Tickets Solved </div>
                    </div>
                    <div class="progress stat-progress">
                        @if($all_tickets->count() > 0)
                        <div class="progress-bar" style="width: {{ $solved_tickets->count() * 100 / $all_tickets->count() }}%;"></div>
                        @endif
                    </div>
                </div>

                {{-- outdated --}}
                <div class="col-md-2 px-2 stat-col">
                    <div class="stat-icon">
                        <a href="{{ route('tickets.status', 'outdated') }}"><i class="far fa-list-alt"></i></a>
                    </div>
                    <div class="stat">
                        <div class="value d-inline">
                            {{ $outdated_tickets->count() . '/' . $all_tickets->count() }}
                        </div>
                        <sup class="badge badge-secondary">{{ $outdated_tickets_perc }}%</sup>
                        <div class="name"> Tickets Outdated </div>
                    </div>
                    <div class="progress stat-progress">
                        @if($all_tickets->count() > 0)
                        <div class="progress-bar" style="width: {{ $outdated_tickets->count() * 100 / $all_tickets->count() }}%;"></div>
                        @endif
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
