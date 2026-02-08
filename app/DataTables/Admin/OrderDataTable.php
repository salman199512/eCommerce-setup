<?php

namespace App\DataTables\Admin;

use App\Models\Order;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('total_amount', function (Order $model) {
                return '₹' . number_format($model->total_amount, 2);
            })
            ->editColumn('status', function (Order $model) {
                $color = 'secondary';
                switch ($model->status) {
                    case 'pending': $color = 'warning'; break;
                    case 'processing': $color = 'info'; break;
                    case 'shipped': $color = 'primary'; break;
                    case 'delivered': $color = 'success'; break;
                    case 'cancelled': $color = 'danger'; break;
                }
                return '<span class="badge bg-'.$color.'">'.ucfirst($model->status).'</span>';
            })
            ->editColumn('payment_status', function (Order $model) {
                $color = $model->payment_status == 'paid' ? 'success' : 'danger';
                return '<span class="badge bg-'.$color.'">'.ucfirst($model->payment_status).'</span>';
            })
            ->editColumn('created_at', function (Order $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->addColumn('action', 'admin.orders.datatables_actions')
            ->rawColumns(['status', 'payment_status', 'action', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'responsive'=> true,
                'dom'       => 'RB<\'row pt-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[count($this->getColumns()) -1 , 'desc']],
                'buttons'   => [],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'order_number',
            'first_name' => ['title' => 'Customer'],
            'total_amount' => ['title' => 'Total'],
            'payment_status',
            'status',
            'created_at' => ['title' => 'Date'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'ordersdatatable_' . time();
    }
}
