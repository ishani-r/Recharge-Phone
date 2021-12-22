<?php

namespace App\DataTables;

use App\Models\Premium;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PremiumDatatable extends DataTable
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
            // ->addColumn('action', 'premiumdatatable.action');
            ->addColumn('action', function ($data) use ($user) {
                $result = '<div class="btn-group">';
                if ($user->can('view-package')) {
                    $result .= '<a href="' . route('admin.premium.show', $data->id) . '"><button class="btn-sm btn-outline-warning" style="border-radius: 2.1875rem;"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                }
                if ($user->can('update-package')) {
                    $result .= '<a href="' . route('admin.premium.edit', $data->id) . '"><button class="btn-sm btn-outline-info" style="border-radius: 2.1875rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                }
                if ($user->can('delete-package')) {
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-outline-danger delete" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></div>';
                }
                return $result;
            })

            ->editColumn('status', function ($data) {
                if ($data['status'] == 'Active') {
                    return '<button type="button" data-id="' . $data->id . '" class="badge rounded-pill bg-success status"> Active </button>';
                } else {
                    return '<button type="button" data-id="' . $data->id . '" class="badge rounded-pill bg-danger status"> Deactive </button>';
                }
            })

            ->rawColumns(['action', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PremiumDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Premium $model)
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
            ->setTableId('premiumdatatable-table')
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
            Column::make('six_months')->title(trans('six_months')),
            Column::make('three_months')->title(trans('three_months')),
            Column::make('one_months')->title(trans('one_months')),
            Column::make('try_days')->title(trans('try_days')),
            Column::make('save')->title(trans('save')),
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
        return 'Premium_' . date('YmdHis');
    }
}
