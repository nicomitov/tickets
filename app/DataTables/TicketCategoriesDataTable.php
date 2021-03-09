<?php

namespace App\DataTables;

use App\TicketCategory;
// use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketCategoriesDataTable extends DataTable
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
            ->editColumn('name', function ($category) {
                return view('partials.btn_edit_modal', [
                    'model' => $category,
                    'route' => 'tickets.categories.update',
                    'redirect' => 'tickets.categories.index',
                    'modal_title' => 'Edit category',
                    'permission' => ['viewAny', TicketCategory::class]
                ]);
            })
            ->editColumn('tickets', function ($category) {
                return '<a href="'.route('tickets.category', $category).'">'.$category->tickets()->count().'</a>';
            })
            ->editColumn('created_at', function ($category) {
                return $category->created_at->format('j-M-Y');
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at->format('j-M-Y');
            })
            ->addColumn('actions', function($category) {
                return view('partials.actions', [
                    'model' => $category,
                    'route' => 'tickets.categories',
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
     * @param \App\App\TicketCategoriesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TicketCategory $model)
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
                    ->setTableId('ticketcategoriesdatatable-table')
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
        return 'TicketCategories_' . date('YmdHis');
    }
}
