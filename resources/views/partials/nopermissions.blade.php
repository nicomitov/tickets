@extends('layouts.app')

@section('page_title')
    Отказан достъп
@endsection

@section('content')
    <div class="alert alert-danger">
        <span class="close" data-dismiss="alert">&times;</span>
        <i class="far fa-frown"></i> Нямате достъп до тази страница!
    </div>
@endsection
