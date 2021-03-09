<ul class="item-list striped">
    {{-- header row --}}
    <li class="item item-list-header">
        <div class="item-row">
            <div class="item-col item-col-header fixed item-col-img xs">
                <div><span class="ml-2"><i class="far fa-user"></i></span></div>
            </div>
            <div class="item-col item-col-header item-col-title" style="flex-grow: 3">
                <div><span>Ticket</span></div>
            </div>
            <div class="item-col item-col-header item-col-stats" style="flex-grow:2">
                <div class="no-wrap"><span>Employee</span></div>
            </div>
            <div class="item-col item-col-header item-col-stats" style="flex-grow:1">
                <div class="no-wrap"><span>Category</span></div>
            </div>
            <div class="item-col item-col-header item-col-stats" style="flex-grow:1">
                <div class="no-wrap"><span>Date</span></div>
            </div>
            <div class="item-col item-col-header item-col-deadline" style="flex-grow:1">
                <div class="no-wrap"><span>Status</span></div>
            </div>
            <div class="item-col item-col-header fixed item-col-actions-dropdown">
                <div><span><i class="fas fa-cog fa-lg"></i></span></div>
            </div>
        </div>
    </li>

    @foreach($tickets as $ticket)
    <li class="item">
        <div class="item-row">
            {{-- image --}}
            <div class="item-col fixed item-col-img xs my-auto">
                <div class="item-img rounded" style="background-image: url({{ $ticket->user->getAvatarThumb() }})" data-rel="tooltip" title="{{ $ticket->user->name }}">
                </div>
            </div>

            {{-- ticket --}}
            <div class="item-col pull-left item-col-title no-overflow" style="flex-grow: 3">
                {{-- <div class="item-heading">Ticket</div> --}}
                <div class="no-wrap">
                    <h4 class="item-title no-wrap">
                        <a href="{{ route('tickets.show', $ticket) }}" class="@cannot('view', $ticket) disabled @endcan">
                            {{ $ticket->name }}
                        </a>
                    </h4>
                </div>
            </div>

            {{-- employee --}}
            <div class="item-col pull-left item-col-stats" style="flex-grow:2">
                <div class="item-heading">Employees</div>
                <div class=""> {{-- no-wrap --}}
                    {!! $ticket->employeesList() !!}
                </div>
            </div>

            {{-- category --}}
            <div class="item-col pull-left item-col-stats" style="flex-grow:1">
                <div class="item-heading">Category</div>
                <div class="no-wrap ">
                    {{ $ticket->category->name }}
                </div>
            </div>

            {{-- date --}}
            <div class="item-col pull-left item-col-stats" style="flex-grow:1">
                <div class="item-heading">Date</div>
                <div class="no-wrap ">
                    {{ $ticket->created_at->format('j-M-Y') }}
                </div>
            </div>

            {{-- status --}}
            <div class="item-col pull-left item-col-deadline" style="flex-grow:1">
                <div class="item-heading">Status</div>
                <div class="">
                    @include('tickets._btn_status')
                </div>
            </div>

            {{-- actions --}}
            <div class="item-col fixed item-col-actions-dropdown">
                <div class="item-actions-dropdown">
                    <a class="item-actions-toggle-btn">
                        <span class="inactive">
                            <i class="fas fa-cog"></i>
                        </span>
                        <span class="active">
                            <i class="fas fa-chevron-circle-right"></i>
                        </span>
                    </a>
                    <div class="item-actions-block">
                        <ul class="item-actions-list">
                            <li>
                                @include('partials.btn_delete_modal', ['model' => $ticket, 'route' => 'tickets.destroy', 'btn_class' => 'remove', 'permission' => ['delete', $ticket]])
                            </li>
                            <li>
                                <a class="edit @cannot('update', $ticket) disabled @endcan" href="{{ route('tickets.edit', [$ticket]) }}" data-rel="tooltip" title="Edit">
                                    <i class="far fa-edit fa-fw"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
