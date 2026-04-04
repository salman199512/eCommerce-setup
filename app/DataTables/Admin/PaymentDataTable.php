<?php

namespace App\DataTables\Admin;

use App\Models\Order;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PaymentDataTable extends DataTable
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
            ->editColumn('payment_status', function (Order $model) {
                $status = strtolower($model->payment_status);
                $color = $status == 'paid' ? 'success' : ($status == 'pending' ? 'warning' : 'danger');
                return '<span class="badge bg-'.$color.'">'.ucfirst($model->payment_status).'</span>';
            })
            ->editColumn('created_at', function (Order $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->addColumn('customer_name', function (Order $model) {
                return $model->first_name . ' ' . $model->last_name;
            })
            ->addColumn('action', 'admin.payments.datatables_actions')
            ->rawColumns(['payment_status', 'action', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = $model->newQuery()->whereNotNull('transaction_id')->orWhere('payment_status', 'paid');
        return $query;
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
            ->addAction(['width' => '120px', 'printable' => false, 'title' => 'Action'])
            ->parameters([
                'responsive'=> true,
                'dom'       => 'RB<\'row pt-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[5 , 'desc']],
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
            ['data' => 'order_number', 'title' => 'Order #'],
            ['data' => 'customer_name', 'title' => 'Customer Name', 'orderable' => false],
            ['data' => 'transaction_id', 'title' => 'Transaction ID'],
            ['data' => 'total_amount', 'title' => 'Amount'],
            ['data' => 'payment_status', 'title' => 'Payment Status'],
            ['data' => 'created_at', 'title' => 'Payment Date'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'paymentsdatatable_' . time();
    }
}
