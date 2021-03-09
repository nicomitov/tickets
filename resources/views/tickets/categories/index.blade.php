@extends('layouts.app')

@section('page_title')
    Ticket categories
@endsection

@section('page_buttons')
    @include('partials.btn_add_modal', ['route' => 'tickets.categories.index', 'title' => 'Add new category', 'permission' => ['create', App\TicketCategory::class]])
    @include('tickets._btn_page')
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
