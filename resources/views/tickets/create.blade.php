@extends('layouts.app')

@section('page_title')
    @lang('New ticket')
@endsection

{{-- @section('page_title_description')
<p class="title-description">
    Page title description
</p>
@endsection --}}

@section('page_buttons')
    @include('tickets._btn_page')
@endsection

@section('content')
<div class="card">
    <div class="card-block">

        {!! Form::open(['url' => 'tickets']) !!}
            @include('tickets._form', [$submitBtnText = __('Save')])
        {!! Form::close() !!}

    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/vendor/tinymce/tinymce.js"></script>
    <script type="text/javascript" src="/js/tinymce.js"></script>
    <script type="text/javascript" src="/js/bsmultiselect.js"></script>
@endsection
