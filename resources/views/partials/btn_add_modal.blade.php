@isset ($permission)
    @can($permission[0], $permission[1])
        <a
            id="create_modal"
            class="btn btn-primary btn-sm"
            data-action="create"
            data-href="{{ route($route) }}"
            data-title="{{ $title }}"
            data-redirect="{{ route($route) }}">

            <i class="fas fa-plus"></i> Add New
        </a>
    @else
        <a id="403" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i> Add New</a>
    @endcan
@else
    <a
        id="create_modal"
        class="btn btn-primary btn-sm"
        data-action="create"
        data-href="{{ route($route) }}"
        data-title="{{ $title }}"
        data-redirect="{{ route($route) }}">

        <i class="fas fa-plus"></i> Add New
    </a>
@endisset
