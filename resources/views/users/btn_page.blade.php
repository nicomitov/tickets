{{-- add --}}
@if(Route::currentRouteName() != 'users.create' && Route::currentRouteName() != 'roles.index' && Route::currentRouteName() != 'departments.index')
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm rounded-s @cannot('create', App\User::class) disabled @endcan">
        <i class="fa fa-plus"></i> Add New
    </a>
@endif

<div class="action dropdown">
    <button class="btn btn-sm rounded-s btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        More actions...
    </button>

     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">

        {{-- delete --}}
        @if(Route::currentRouteName() == 'users.edit')
            {{ Form::open(['method' => 'DELETE', 'class' => 'd-inline form-delete', 'route' => ['users.destroy', $user ]]) }}
                @include('partials.btn_delete_modal', ['model' => $user, 'route' => 'users.destroy', 'btn_class' => 'dropdown-item', 'title' => 'Delete User', 'permission' => ['delete', $user]])
            {{ Form::close() }}
            <div class="dropdown-divider"></div>
        @endif

        @if(Route::currentRouteName() == 'users.show')
            <a href="{{ route('users.edit', $user) }}" class="dropdown-item @cannot('viewAny', App\User::class) disabled @endcan">
                <i class="far fa-edit icon"></i> Edit User
            </a>
            <div class="dropdown-divider"></div>
        @endif

        @if(Route::currentRouteName() != 'roles.index')
            <a href="{{ route('roles.index') }}" class="dropdown-item @cannot('viewAny', App\Role::class) disabled @endcan">
                <i class="fa fa-cog icon"></i> Edit Roles
            </a>
        @endif

        <a class="dropdown-item @cannot('viewAny', App\Department::class) disabled @endcannot" href="{{ route('departments.index') }}">
            <i class="fas fa-cog icon"></i> Edit departments
        </a>
     </div>
</div>
