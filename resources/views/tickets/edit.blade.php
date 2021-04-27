@extends('layouts.app')

@section('page_title')
    @lang('Edit ticket')
@endsection

@section('page_buttons')
    @include('tickets._btn_page')
@endsection

@section('content')
<div class="card">
    <div class="card-block">
        {!! Form::model($ticket, ['method' => 'PATCH', 'action' => ['TicketController@update', $ticket]]) !!}
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
