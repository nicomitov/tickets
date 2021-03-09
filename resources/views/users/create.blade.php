@extends('layouts.app')

@section('page_title')
    @lang('New user')
@endsection

@section('page_buttons')
    @include('users.btn_page')
@endsection

{{-- @section('page_title_description')
@endsection --}}

@section('content')
<div class="card">
    <div class="card-block">
        {!! Form::open(['url' => 'users']) !!}
            @include('users.form', [$submitBtnText = __('Save')])
        {!! Form::close() !!}
    </div>
</div>
@endsection

{{-- @section('js')
    <script type="text/javascript" src="/js/bsmultiselect.js"></script>
@endsection --}}
