<?php

namespace App\DataTables;

use App\TicketPriority;
// use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketPrioritiesDataTable extends DataTable
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
            ->editColumn('name', function ($priority) {
                return view('partials.btn_edit_modal', [
                    'model' => $priority,
                    'route' => 'tickets.priorities.update',
                    'redirect' => 'tickets.priorities.index',
                    'modal_title' => 'Edit priority',
                    'permission' => ['viewAny', TicketPriority::class]
                ]);
            })
            ->editColumn('tickets', function ($priority) {
                return '<a href="'.route('tickets.priority', $priority).'">'.$priority->tickets()->count().'</a>';
            })
            ->editColumn('created_at', function ($priority) {
                return $priority->created_at->format('j-M-Y');
            })
            ->editColumn('updated_at', function ($priority) {
                return $priority->updated_at->format('j-M-Y');
            })
            ->addColumn('actions', function($priority) {
                return view('partials.actions', [
                    'model' => $priority,
                    'route' => 'tickets.priorities',
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
     * @param \App\App\TicketPrioritiesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TicketPriority $model)
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
                    ->setTableId('ticketprioritiesdatatable-table')
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
        return 'TicketPriorities_' . date('YmdHis');
    }
}
