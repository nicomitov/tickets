@isset ($permission)
    @can($permission[0], $permission[1])

        {{ Form::open([
            'method' => 'DELETE',
            'class' => 'd-inline form-delete',
            'route' => [$route, $model]
        ]) }}

        <button type="submit" class="del {{ $btn_class }}" data-toggle="modal" data-target="#modal" tag="button" data-message="{{ isset($message) ? $message : null }}">
            @isset($title)
                <i class="far fa-trash-alt icon"></i>
                {{ $title }}
            @else
                <i class="far fa-trash-alt icon"></i>
            @endisset
        </button>

        {{ Form::close() }}

    @else

        <button id="403" class="del {{ $btn_class }} disabled" data-toggle="modal" data-target="#modal" tag="button" data-message="{{ isset($message) ? $message : null }}">
            @isset($title)
                <i class="far fa-trash-alt icon"></i>
                {{ $title }}
            @else
                <i class="far fa-trash-alt icon"></i>
            @endisset
        </button>

    @endcan
@else
    {{ Form::open([
        'method' => 'DELETE',
        'class' => 'd-inline form-delete',
        'route' => [$route, $model]
    ]) }}

    <button type="submit" class="del {{ $btn_class }}" data-toggle="modal" data-target="#confirm" tag="button" data-message="{{ isset($message) ? $message : null }}">
        <i class="far fa-trash-alt icon"></i>
    </button>

    {{ Form::close() }}
@endisset
