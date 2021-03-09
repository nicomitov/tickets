@extends('layouts.app')

@section('page_title')
    @lang('Departments')
@endsection

@section('page_buttons')
    @include('partials.btn_add_modal', ['route' => 'departments.index', 'title' => 'Add new department', 'permission' => ['viewAny', App\Department::class]])
    @include('users.btn_page')
@endsection

@section('page_title_description')

@endsection

@section('filter')
@endsection

@section('content')
    <div class="table-responsive">
        {{ $dataTable->table(['class' => 'table-sm table-striped']) }}
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
