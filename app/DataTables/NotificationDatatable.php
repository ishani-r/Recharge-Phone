<?php

namespace App\DataTables;

use App\Models\Notification;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationDatatable extends DataTable
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
            // ->addColumn('action', 'notificationdatatable.action');

            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
                // $result .= '<a href="'.route('admin.show_user_   list',$data->id).'"><button class="btn-sm btn-outline-warning" style="border-radius: 2.1875rem;"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                // $result .= '<a href="'.route('admin.permission.edit',$data->id).'"><button class="btn-sm btn-outline-info" style="border-radius: 2.1875rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-outline-danger delete" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></div>';
                return $result;
            })
            ->editColumn('user_id', function ($data) {
                $quiz = User::where('id', $data->user_id)->first();
                return $quiz->name;
            })

            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NotificationDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
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
                    ->setTableId('notificationdatatable-table')
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
            Column::make('id'),
            Column::make('user_id'),
            Column::make('message'),
            Column::make('recharge_point'),
            Column::make('status'),
            Column::computed('action')
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
        return 'Notification_' . date('YmdHis');
    }
}
