<?php

namespace App\DataTables;

use App\User;
use App\Department;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('name', function ($user) {
                return '<a href="'.route('users.show', $user).'" class="font-weight-bold">'.$user->name.'</a>';
            })
            ->addColumn('department_id', function($user) {
                return $user->department->name;
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('j-M-Y');
            })
            ->addColumn('actions', function($user) {
                return view('partials.actions', [
                    'model' => $user,
                    'route' => 'users',
                    'message' => ''
                ]);
            })
            ->rawColumns(['name', 'actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $model->newQuery();

        if (request('department')) {
            $query->where('department_id',  request('department')->id);
        }
        if (request('role')) {
            $query->whereHas('roles',  function ($q) {
                        $q->where('id', request('role')->id);
                    });
        }
        if (request('stat')) {
            if (request('stat') == 'active') {
                $query = User::activeUsers();
            }
            if (request('stat') == 'inactive') {
                $query = User::inactiveUsers();
            }
            if (request('stat') == 'trashed') {
                $query = User::onlyTrashed();
            }
        }

        return $query->with('department')->select('users.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->parameters([
                        "pageLength" => 24,
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
            Column::computed('department.name', 'Department')
                  ->orderable()
                  ->searchable(),
            Column::make('work_phone')
                  ->orderable(false),
            Column::make('mobile_phone')
                  ->orderable(false),
            Column::make('email'),
            Column::make('created_at')
                  ->width(100)
                  ->title('Joined')
                  ->addClass('text-right'),
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
        return 'Users_' . date('YmdHis');
    }
}
