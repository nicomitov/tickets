@if ($errors->any())
    <ul class="alert alert-danger">
        <span class="close" data-dismiss="alert" role="button">&times;</span>
        @foreach ($errors->all() as $error)
            <li><i class="fas fa-info-circle fa-lg fa-fw" aria-hidden="true"></i> {{ $error }}</li>
        @endforeach
    </ul>
@endif
