@extends('layouts.app')

@section('page_title')
    @lang('Tickets')
@endsection

@section('page_title_description')

@endsection

@section('page_buttons')
    <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm @cannot('create', App\Ticket::class) disabled @endcan">
        <i class="fas fa-plus"></i> Add New
    </a>
    @include('tickets._btn_page')
@endsection

@section('filter')
    @include('tickets._filter')
@endsection

{{-- @section('content')

@if($tickets->count() > 0)
    <span class="dashboard-page">
        <div class="card items">
            @include('tickets._list')
        </div>
    </span>

@else
    @include('partials.noentries')
@endif

<div class="pull-right">
    {{ $tickets->links() }}
</div>
<div class="pagination-info">
    Tickets: {{ $tickets->firstItem() }}-{{ $tickets->lastItem() }} of {{ $tickets->total() }}
</div>

@endsection --}}

@section('content')
    <div class="table-responsive">
        {{ $dataTable->table(['class' => 'table-sm table-striped']) }}
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
