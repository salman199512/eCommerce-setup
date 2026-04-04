<?php

namespace App\DataTables\Admin;

use App\Models\User;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\DB;

class CustomerDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('total_orders', function(User $user){
                return $user->orders_count;
            })
            ->addColumn('total_spent', function(User $user){
                return '₹' . number_format($user->orders_sum_total_amount ?? 0, 2);
            })
            ->editColumn('created_at', function (User $user){
                return GeneralHelperFunctions::prepareHtmlDate($user->created_at);
            })
            ->addColumn('action', 'admin.customers.datatables_actions')
            ->rawColumns(['action', 'created_at']);
    }

    public function query(User $model)
    {
        // Only get users with 'customer' role
        return $model->newQuery()
            ->role('customer')
            ->withCount('orders')
            ->withSum('orders', 'total_amount');
    }

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
                'order'     => [[5 , 'desc']],
            ]);
    }

    protected function getColumns()
    {
        return [
            'name',
            'email',
            'mobile',
            ['data' => 'total_orders', 'title' => 'Total Orders', 'searchable' => false],
            ['data' => 'total_spent', 'title' => 'Total Spent', 'searchable' => false],
            'created_at' => ['title' => 'Added on'],
        ];
    }

    protected function filename() : string
    {
        return 'customersdatatable_' . time();
    }
}
