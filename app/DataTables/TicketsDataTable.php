<?php

namespace App\DataTables;

use App\Ticket;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketsDataTable extends DataTable
{
    public function getTicket($ticket)
    {
        return Ticket::find($ticket->id);
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->query($query)
            ->editColumn('pic', function ($ticket) {
                $ticket = $this->getTicket($ticket);

                return '<div class="item-img rounded" style="background-image: url('.$ticket->user->getAvatarThumb().')" data-rel="tooltip" title="'.$ticket->user->name.'"></div>';
            })
            ->editColumn('name', function ($ticket) {
                return '<a href="'.route('tickets.show', $ticket->id).'" class="font-weight-bold">'.$ticket->name.'</a>';
            })
            ->addColumn('employee', function($ticket) {
                $ticket = $this->getTicket($ticket);

                return $ticket->employeesList();
            })
            ->editColumn('created_at', function ($ticket) {
                return date("j-M-Y", strtotime($ticket->created_at));
            })
            ->editColumn('ticket_statuses.name', function ($ticket) {
                $ticket = $this->getTicket($ticket);

                return view('tickets._btn_status', ['ticket' => $ticket]);
            })
            ->addColumn('actions', function($ticket) {
                $ticket = $this->getTicket($ticket);

                return view('partials.actions', [
                    'model' => $ticket,
                    'route' => 'tickets',
                    'message' => ''
                ]);
            })
            ->rawColumns(['pic', 'name', 'actions', 'employee']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TicketsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ticket $model)
    {
        $query =
            DB::table('tickets')
                ->join('ticket_statuses', 'tickets.status_id', '=', 'ticket_statuses.id')
                ->select(
                    'tickets.id',
                    'tickets.name',
                    'tickets.created_at',
                );

            if (request('user')) {
                $query->where('user_id', request('user')->id);
            }

            if (request('status')) {
                $query->where('status_id', request('status')->id);
            }

            if (request('category')) {
                $query->where('category_id', request('category')->id);
            }

            if (request('priority')) {
                $query->where('priority_id', request('priority')->id);
            }

            if (request('employee')) {
                $query->join('ticketables', function($join) {
                    $join->on('ticketables.ticket_id', '=', 'tickets.id')
                         ->on('ticketables.id', '=', DB::raw("(select min(id) from ticketables WHERE ticketables.ticket_id = tickets.id)"));
                })
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'ticketables.ticketable_id')
                        ->where('ticketables.ticketable_type', '=', 'App\User');
                    });
                $query->where('users.id', request('employee')->id);
            }

            if (request('department')) {
                $query->join('ticketables', function($join) {
                    $join->on('ticketables.ticket_id', '=', 'tickets.id')
                         ->on('ticketables.id', '=', DB::raw("(select min(id) from ticketables WHERE ticketables.ticket_id = tickets.id)"));
                })
                ->join('departments', function ($join) {
                    $join->on('departments.id', '=', 'ticketables.ticketable_id')
                        ->where('ticketables.ticketable_type', '=', 'App\Department');
                    });
                $query->where('departments.id', request('department')->id);
            }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('tickets-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->parameters([
                        "pageLength" => 16,
                        "responsive" => true,
                        "deferRender" => true,
                        "oLanguage" => [
                           "sSearch" => "Filter"
                        ],
                    ])
                    ->orderBy(4, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('pic', '<i class="far fa-user"></i>')
                  ->orderable(false)
                  ->searchable(false)
                  ->addClass('text-center')
                  ->width(20),
            Column::computed('name', 'Ticket')
                  ->orderable()
                  ->searchable(),
            Column::computed('employee', 'Employee'),
            Column::computed('created_at', 'Created')
                  ->addClass('text-right')
                  ->width(100)
                  ->orderable()
                  ->searchable(),
            Column::computed('ticket_statuses.name', 'Status')
                  ->addClass('text-right')
                  ->width(100)
                  ->orderable()
                  ->searchable(),
            Column::computed('actions', '<i class="fas fa-cog"></i>')
                  ->addClass('text-right')
                  ->width(50)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Tickets_' . date('YmdHis');
    }
}
