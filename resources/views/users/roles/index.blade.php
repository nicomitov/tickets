@extends('layouts.app')

@section('page_title')
Site Modules
@endsection

@section('page_title_description')
@endsection

@section('page_buttons')
    @include('partials.btn_add_modal', ['route' => 'roles.index', 'title' => 'Add new role', 'permission' => ['viewAny', App\Role::class]])
    {{-- @include('users.btn_page') --}}
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
