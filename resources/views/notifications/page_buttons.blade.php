{{ Form::open(['method' => 'DELETE', 'class' => 'd-inline', 'route' => ['notifications.read_all']]) }}

    <button type="submit" class="btn btn-primary btn-sm rounded-s" role="button" title="Mark all notifications as read" data-rel="tooltip">
        <i class="far fa-eye"></i> Mark all as read
    </button>

{{ Form::close() }}

{{ Form::open(['method' => 'DELETE', 'class' => 'd-inline form-delete', 'route' => ['notifications.delete_all']]) }}

    <button type="submit" class="btn btn-danger btn-sm rounded-s" role="button" title="Delete all notifications" data-toggle="modal" data-target="#confirm" data-rel="tooltip">
        <i class="far fa-trash-alt"></i> Delete all
    </button>

{{ Form::close() }}
