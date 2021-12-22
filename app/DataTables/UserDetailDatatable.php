<?php

namespace App\DataTables;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDetailDatatable extends DataTable
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
            // ->addColumn('action', 'userdetaildatatable.action')
            ->addColumn('action', function($data) use ($user) {
                $result = '<div class="btn-group">';
                if ($user->can('view-userdetail-data')) {
                    $result .= '<a href="'.route('admin.details.show',$data->id).'"><button class="btn-sm btn-outline-warning" style="border-radius: 2.1875rem;"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                }
                // $result .= '<a href="'.route('admin.dashboard.edit',$data->id).'"><button class="btn-sm btn-outline-info">Edit</button></a>';
                if ($user->can('delete-userdetail-data')) {
                    $result .= '<button type="submit" data-id="'.$data->id.'" class="btn-sm btn-outline-danger delete" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></div>';
                }
                return $result;
            })

            ->editColumn('user_id', function($data){
                return $data->user['name'];
            })

            ->editColumn('status', function ($data) {
                if($data['status'] == 'Active')
                {
                    return '<button type="button" data-id="'.$data->id.'" class="badge rounded-pill bg-success status"> Active </button>';
                }else{
                    return '<button type="button" data-id="'.$data->id.'" class="badge rounded-pill bg-danger status"> Deactive </button>';
                }
            })

            ->rawColumns(['action','user_id','status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDetailDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserDetail $model)
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
                    ->setTableId('userdetaildatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('user_id')->title(trans('user_id')),
            Column::make('country')->title(trans('country')),
            Column::make('state')->title(trans('state')),
            Column::make('city')->title(trans('city')),
            Column::make('address')->title(trans('address')),
            Column::make('education')->title(trans('education')),
            Column::make('work')->title(trans('work')),
            Column::make('employer')->title(trans('employer')),
            Column::make('about_me')->title(trans('about_me')),
            Column::make('height')->title(trans('height')),
            Column::make('speaks')->title(trans('speaks')),
            Column::make('cast')->title(trans('cast')),
            Column::make('smoking')->title(trans('smoking')),
            Column::make('drinks')->title(trans('drinks')),
            Column::make('food')->title(trans('food')),
            Column::make('marray_age')->title(trans('marray_age')),
            Column::make('dressing')->title(trans('dressing')),
            // Column::make('latitude')->title(trans('')),
            // Column::make('longitude')->title(trans('')),
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
        return 'UserDetail_' . date('YmdHis');
    }
}
