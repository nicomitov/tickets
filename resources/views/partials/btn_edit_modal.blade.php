@isset ($permission)
    @can($permission[0], $permission[1])
        <a href=""
            id="edit_modal"
            data-action="edit"
            data-model="{{ $model }}"
            data-href="{{ route($route, $model) }}"
            data-title="{{ $modal_title }}"
            data-redirect="{{ route($redirect) }}"
            @isset($manuf)
                data-manuf="{{ $manuf->toDateString() }}"
            @endisset
            @isset($purch)
                data-purch="{{ $purch->toDateString() }}"
            @endisset
             @isset($warr)
                data-warr="{{ $warr->toDateString() }}"
            @endisset
            @isset($perms)
                data-permissions="{{ $perms }}"
            @endisset
            @isset($rls)
                data-roles="{{ $rls }}"
            @endisset
            @isset($class)
                class="{{ $class }}"
            @endisset >

            @isset($title)
                @if ($title == 'icon')
                    <i class="far fa-edit icon"></i>
                @else
                    <i class="far fa-edit icon"></i> {{ $title }}
                @endif

            @else
                {{-- <h4 class="item-title">{{ $model->name }}</h4> --}}
                <strong>{{ $model->name }}</strong>
            @endisset
        </a>
    @else
        <a href="" id="403" class="{{ isset($class) ? $class : null }} disabled">
            @isset($title)
                @if ($title == 'icon')
                    <i class="far fa-edit icon"></i>
                @else
                    <i class="far fa-edit icon"></i> {{ $title }}
                @endif

            @else
                {{-- <h4 class="item-title">{{ $model->name }}</h4> --}}
                <strong>{{ $model->name }}</strong>
            @endisset
        </a>

    @endcan
@else
    <a href=""
            id="edit_modal"
            data-action="edit"
            data-model="{{ $model }}"
            data-href="{{ route($route, $model) }}"
            data-title="{{ $modal_title }}"
            data-redirect="{{ route($redirect) }}"
            @isset($manuf)
                data-manuf="{{ $manuf->toDateString() }}"
            @endisset
            @isset($purch)
                data-purch="{{ $purch->toDateString() }}"
            @endisset
             @isset($warr)
                data-warr="{{ $warr->toDateString() }}"
            @endisset
            @isset($perms)
                data-permissions="{{ $perms }}"
            @endisset
            @isset($rls)
                data-roles="{{ $rls }}"
            @endisset
            @isset($class)
                class="{{ $class }}"
            @endisset >

            @isset($title)
                @if ($title == 'icon')
                    <i class="far fa-edit fa-fw"></i>
                @else
                    <i class="far fa-edit fa-fw"></i> {{ $title }}
                @endif

            @else
                {{-- <h4 class="item-title">{{ $model->name }}</h4> --}}
                <strong>{{ $model->name }}</strong>
            @endisset
        </a>
@endisset
