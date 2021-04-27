<?php

namespace App\DataTables;

use App\Department;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DepartmentsDataTable extends DataTable
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
            ->editColumn('name', function ($department) {
                return view('partials.btn_edit_modal', [
                    'model' => $department,
                    'route' => 'departments.update',
                    'redirect' => 'departments.index',
                    'modal_title' => 'Edit department',
                    'permission' => ['viewAny', Department::class]
                ]);
            })
            ->addColumn('employees', function($department) {
                return '<a href="'.route('users.department', $department).'">'.$department->users_count.'</a>';
            })
            ->addColumn('tickets', function($department) {
                return '<a href="'.route('tickets.department', $department).'">'.$department->caused_tickets_count.'</a>';
            })
            ->editColumn('created_at', function ($department) {
                return $department->created_at->format('j-M-Y');
            })
            ->editColumn('updated_at', function ($department) {
                return $department->updated_at->format('j-M-Y');
            })
            ->addColumn('actions', function($department) {
                return view('partials.actions', [
                    'model' => $department,
                    'route' => 'departments',
                    'message' => '',
                    // 'permission' => ['viewAny', Role::class],
                    'modal' => true
                ]);
            })
            ->rawColumns(['name', 'actions', 'employees', 'tickets', 'hardware']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\DepartmentsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $model)
    {
        return $model->newQuery()->withCount(['causedTickets', 'users']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('departments-table')
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
            Column::computed('employees')
                  ->addClass('text-center')
                  ->width(200),
            Column::computed('tickets')
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
        return 'Departments_' . date('YmdHis');
    }
}
