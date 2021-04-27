<div class="ml-xl-4 filter">
    <div class="card">
        <div class="list-group-flush condensed">

            <a class="title d-block d-xl-none list-group-item click" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                Filter <span class="pull-right"><i class="fas fa-chevron-right"></i></span>
            </a>

            <div id="collapse" class="collapse show">
                @foreach(\App\Department::get() as $dept)
                    <a href="{{ route('users.department', $dept) }}" class="list-group-item text-nowrap {{ isActiveUrl(route('users.department', $dept)) }}">
                        <i class="far fa-circle fa-fw fa-lg text-primary"></i> {{ $dept->name }}
                        <span class="badge badge-light badge-pill pull-right">
                            {{ $dept->users->count() }}
                        </span>
                    </a>
                @endforeach

                <a class="list-group-item divider"></a>

                {{-- active --}}
                <a href="{{ route('users.stat', 'active') }}" class="list-group-item text-nowrap {{ isActiveUrl(route('users.stat', 'active')) }}">
                    <i class="fas fa-power-off fa-fw fa-lg text-success"></i> Active <span class="badge badge-light badge-pill pull-right">{{ App\User::activeUsers()->count() }}</span>
                </a>

                {{-- inactive --}}
                <a href="{{ route('users.stat', 'inactive') }}" class="list-group-item text-nowrap {{ isActiveUrl(route('users.stat', 'inactive')) }}">
                    <i class="fas fa-power-off fa-fw fa-lg text-danger"></i> Inactive <span class="badge badge-light badge-pill pull-right">{{ App\User::inactiveUsers()->count() }}</span>
                </a>

                {{-- deleted --}}
                <a href="{{ route('users.stat', 'trashed') }}" class="list-group-item text-nowrap {{ isActiveUrl(route('users.stat', 'trashed')) }}">
                    <i class="far fa-trash-alt fa-fw fa-lg text-danger"></i> Deleted <span class="badge badge-light badge-pill pull-right">{{ App\User::onlyTrashed()->count() }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
