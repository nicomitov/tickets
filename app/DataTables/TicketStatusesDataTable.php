<?php

namespace App\DataTables;

use App\TicketStatus;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketStatusesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($status) {
                return view('partials.btn_edit_modal', [
                    'model' => $status,
                    'route' => 'tickets.statuses.update',
                    'redirect' => 'tickets.statuses.index',
                    'modal_title' => 'Edit status',
                    'permission' => ['viewAny', TicketStatus::class]
                ]);
            })
            ->editColumn('tickets', function ($status) {
                return '<a href="'.route('tickets.status', $status).'">'.$status->tickets()->count().'</a>';
            })
            ->editColumn('created_at', function ($status) {
                return $status->created_at->format('j-M-Y');
            })
            ->editColumn('updated_at', function ($status) {
                return $status->updated_at->format('j-M-Y');
            })
            ->addColumn('actions', function($status) {
                return view('partials.actions', [
                    'model' => $status,
                    'route' => 'tickets.statuses',
                    'message' => '',
                    // 'permission' => ['viewAny', Role::class],
                    'modal' => true
                ]);
            })
            ->rawColumns(['name', 'actions', 'tickets']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TicketStatusesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TicketStatus $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ticketstatuses-table')
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
                    ->orderBy(0, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('tickets')
                  ->searchable(false)
                  ->orderable(false)
                  ->addClass('text-center')
                  ->width(200),
            Column::make('created_at')
                  ->addClass('text-right')
                  ->width(100),
            Column::make('updated_at')
                  ->addClass('text-right')
                  ->width(100),
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
        return 'TicketStatuses_' . date('YmdHis');
    }
}
