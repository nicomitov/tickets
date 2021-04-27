@extends('layouts.app')

@section('page_title')
@lang('Employees')
@endsection

@section('page_title_description')

@endsection

@section('page_buttons')
    @include('users.btn_page')
@endsection

@section('filter')
    @include('users.filter')
@endsection

@section('content')
    <div class="table-responsive">
        {{ $dataTable->table(['class' => 'table-sm table-striped']) }}
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
