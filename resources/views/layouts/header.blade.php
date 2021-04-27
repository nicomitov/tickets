<header class="header">
    <div class="header-block header-block-collapse d-lg-none d-xl-none">
        <button class="collapse-btn" id="sidebar-collapse-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="header-block header-block-nav">
        <ul class="nav-profile">

            {{-- plus btn --}}
            <li class="notifications new">
                <a href="" data-toggle="dropdown" class="pl-3">
                    <i class="fas fa-plus"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="min-width: 200px">
                    @can('create', App\Ticket::class)
                    <a href="{{ route('tickets.create') }}" class="dropdown-item px-3 py-2">
                        <i class="far fa-list-alt icon"></i> @lang('Ticket')
                    </a>
                    @endcan

                    @can('create', App\User::class)
                    <a href="{{ route('users.create') }}" class="dropdown-item px-3 py-2">
                        <i class="fas fa-user-tie icon"></i> @lang('Employee')
                    </a>
                    @endcan
                </div>
            </li>

            {{-- notifications btn --}}
            <li class="notifications new">
                <a href="" data-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <sup>
                        <span class="counter">{!! auth()->user()->unreadNotifications->count() > 0 ? auth()->user()->unreadNotifications->count() : '' !!}</span>
                    </sup>
                </a>
                <div class="dropdown-menu  dropdown-menu-right notifications-dropdown-menu">
                    <ul class="notifications-container">
                        @foreach($notifications as $notification)
                        <li class="{{ is_null($notification->read_at) ? 'alert-warning' : '' }}">
                            <a href="{{ route('notifications.show', $notification) }}" class="notification-item">
                                <div class="img-col">
                                    <div class="img" style="background-image: url('{{ $notification->data['image'] }}')">
                                    </div>
                                </div>
                                <div class="body-col w-100">
                                    <p class="w-100">
                                        <span class="accent">
                                            {{ $notification->data['author'] }}
                                        </span>
                                        {{ $notification->data['action'] }}
                                        <span class="pull-right small text-muted ml-1">{{ $notification->created_at->diffForHumans() }}</span>
                                        <span class="accent">{{ $notification->data['subject'] }}</span>
                                    </p>

                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <footer>
                        <ul>
                            <li>
                                <a href="{{ route('notifications.index') }}"> @lang('All Notifications') <i class="fas fa-angle-double-right fa-lg fa-fw text-primary"></i> </a>
                            </li>
                        </ul>
                    </footer>
                </div>
            </li>


            {{-- USER --}}
            <li class="profile dropdown">
                <a class="nav-link dropdown-toggle dropdown-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="img" style="background-image: url('{{ Auth::user()->getAvatarThumb() }}')">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown-menu" aria-labelledby="dropdownMenu1">

                    <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">
                        <i class="far fa-user icon"></i> @lang("Profile")
                    </a>
                    <a class="dropdown-item" href="{{ route('notifications.index') }}">
                        <i class="far fa-bell icon"></i> @lang("My notifications")
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off icon"></i> @lang("Logout")
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
