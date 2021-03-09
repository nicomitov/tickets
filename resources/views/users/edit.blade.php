@extends('layouts.app')

@section('page_title')
    @lang('Edit user')
@endsection

{{-- @section('page_title_description')
@endsection --}}

@section('page_buttons')
    @include('users.btn_page')
    {{-- @include('partials.btn_more_actions', ['route' => 'users', 'model' => $user, 'key' => 'email']) --}}
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user]]) !!}
            @include('users.form', [$submitBtnText = __('Save')])
        {!! Form::close() !!}
    </div>
</div>



@endsection

@section('js')
    {{-- <script type="text/javascript" src="/js/bsmultiselect.js"></script> --}}
    <script type="text/javascript" src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script type="text/javascript">
        $('#lfm').filemanager('image');
    </script>
@endsection
