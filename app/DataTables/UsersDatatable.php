<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $user = Auth()->guard('admin')->user();
        return datatables()
            ->eloquent($query)
            // ->addColumn('action', 'usersdatatable.action');
            ->addColumn('action', function ($data) use ($user) {
                $result = '<div class="btn-group">';
                if ($user->can('view-user-data')) {
                    $result .= '<a href="' . route('admin.dashboard.show', $data->id) . '"><button class="btn-sm btn-outline-warning" style="border-radius: 2.1875rem;"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                }
                if ($user->can('update-user-data')) {
                    $result .= '<a href="' . route('admin.dashboard.edit', $data->id) . '"><button class="btn-sm btn-outline-info" style="border-radius: 2.1875rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                }
                if ($user->can('delete-user-data')) {
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-outline-danger delete" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></div>';
                }
                return $result;
            })

            ->editColumn('image', function ($data) {
                if ($data->image) {
                    return '<img src="' . asset('storage/admin/' . $data->image) . '" width="50px">';
                } else {
                    return '<img src="' . asset('storage/admin/' . $data->image) . '" width="50px">';
                }
            })

            ->editColumn('status', function ($data) {
                if ($data['status'] == 'Active') {
                    return '<button type="button" data-id="' . $data->id . '" class="badge rounded-pill bg-success status"> Active </button>';
                } else {
                    return '<button type="button" data-id="' . $data->id . '" class="badge rounded-pill bg-danger status"> Deactive </button>';
                }
            })

            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UsersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ->setTableId('usersdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex')->title(trans('id')),
            Column::make('name')->title(trans('name')),
            Column::make('mobile')->title(trans('mobile')),
            Column::make('email')->title(trans('email')),
            Column::make('gender')->title(trans('gender')),
            Column::make('dob')->title(trans('dob')),
            Column::make('image')->title(trans('image')),
            Column::make('status')->title(trans('status')),
            Column::computed('action')->title(trans('action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
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
