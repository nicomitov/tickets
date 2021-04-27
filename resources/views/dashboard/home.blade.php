@extends('layouts.app')

@section('page_title')
    @lang('Dashboard')
@endsection

@section('page_title_description')
@endsection

@section('filter')
@endsection

@section('content')

    {{-- <div class="title-block d-block d-lg-none">
        <h1 class="title">@lang('Dashboard')</h1>
    </div> --}}

    {{-- STATS - LOG --}}
    <section class="section dashboard-page mb-0 mt-3">
        <div class="row sameheight-container">
            @include('dashboard.stats')
        </div>
    </section>

    {{-- TICKETS --}}
    <section class="section dashboard-page mb-0">
        <div class="row sameheight-container">
            <div class="col-xl-10 col-xxl-8 ml-auto">
                <div class="card sameheight-item items dash_stats" data-exclude="">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h3 class="title"> @lang('Latest Tickets') </h3>
                        </div>
                        <div class="header-block pull-right">
                            <a href="{{ route('tickets.index') }}" class="btn btn-primary-outline btn-sm rounded pull-right"> View All </a>
                        </div>
                    </div>
                    @can('viewAny', App\Ticket::class)
                        @if($all_tickets->count() > 0)
                            @include('tickets._list', [
                                'tickets' => $all_tickets->take(6)
                            ])
                        @else
                        <div class="col-12 mt-3">
                            @include('partials.noentries')
                        </div>
                        @endif
                    @endcan
                </div>
            </div>

            {{-- employee charts --}}
            <div class="col-md-6 col-xxl-2 mr-auto">
                <div class="card sameheight-item tickets-stats" data-exclude="xs,sm,lg">
                    <div class="card-header">
                        <div class="header-block">
                            <h3 class="title"> Employee Tickets </h3>
                        </div>
                    </div>
                    <div class="card-block">
                        @if(auth()->user()->can('viewAny', App\Ticket::class) && !is_null($data_tickets))
                            <div class="chart" id="dashboard-empl-tickets-chart" data-chart="{{ $data_tickets }}" data-id="dashboard-empl-tickets-chart"></div>
                        @else
                            @include('partials.noentries')
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('js')
    {{-- <script type="text/javascript" src="js/vendor.js"></script> --}}
    <script type="text/javascript" src="js/charts.js"></script>
@endsection
