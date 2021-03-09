<?php

namespace App\DataTables;

use App\Role;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
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
            ->editColumn('name', function ($role) {
                return view('partials.btn_edit_modal', [
                    'model' => $role,
                    'route' => 'roles.update',
                    'redirect' => 'roles.index',
                    'modal_title' => 'Edit role',
                    'permission' => ['viewAny', Role::class]
                ]);
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at->format('j-M-Y');
            })
            ->editColumn('updated_at', function ($role) {
                return $role->updated_at->format('j-M-Y');
            })
            ->addColumn('actions', function($role) {
                return view('partials.actions', [
                    'model' => $role,
                    'route' => 'roles',
                    'message' => '',
                    // 'permission' => ['viewAny', Role::class],
                    'modal' => true
                ]);
            })
            ->rawColumns(['name', 'actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\RolesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
                    ->setTableId('roles-table')
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
        return 'Roles_' . date('YmdHis');
    }
}
