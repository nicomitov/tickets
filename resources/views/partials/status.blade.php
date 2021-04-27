{{-- session status --}}
@if (session('status'))
    <div class="alert alert-success fade show" role="alert" id="alert" data-dismiss="alert">
        {{-- <span class="close" data-dismiss="alert" role="button">&times;</span> --}}
        <i class="far fa-check-circle fa-lg fa-fw" aria-hidden="true"></i> {{ session('status') }}
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning fade show" role="alert" id="alert" data-dismiss="alert">
        <span class="close" data-dismiss="alert" role="button">&times;</span>
        <i class="fas fa-info fa-lg fa-fw" aria-hidden="true"></i> {{ session('warning') }}
    </div>
@endif

{{-- url get --}}
@if(strpos(request()->getUri(), 'created'))
    <div class="alert alert-success fade show" role="alert" id="alert" data-dismiss="alert">
        {{-- <span class="close" data-dismiss="alert" role="button">&times;</span> --}}
        <i class="fas fa-check fa-lg fa-fw" aria-hidden="true"></i> Successfully created!
    </div>
@elseif(strpos(request()->getUri(), 'updated'))
    <div class="alert alert-success fade show" role="alert" id="alert" data-dismiss="alert">
        {{-- <span class="close" data-dismiss="alert" role="button">&times;</span> --}}
        <i class="fas fa-check fa-lg fa-fw" aria-hidden="true"></i> Successfully updated!
    </div>
@elseif(strpos(request()->getUri(), 'success'))
    <div class="alert alert-success fade show" role="alert" id="alert" data-dismiss="alert">
        {{-- <span class="close" data-dismiss="alert" role="button">&times;</span> --}}
        <i class="fas fa-check fa-lg fa-fw" aria-hidden="true"></i> Successfully created!
    </div>
@endif
