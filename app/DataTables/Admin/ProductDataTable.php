<?php

namespace App\DataTables\Admin;

use App\Models\Product;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('status', function (Product $model) {
                 if ($model->status == '1') {
                    $status = 'checked';
                    $val = '0';
                } else {
                    $status = '';
                    $val = '1';
                }
                $alert = 'Are you sure?';
                $tableId = 'dataTableBuilder';
                $urlStatus = route('admin.products.status-change', $model->uuid) . '?active=' . $val;

                return view('admin.layouts.status', compact('model', 'tableId','status','alert','urlStatus'));
            })
            ->editColumn('category_id', function (Product $product){
                return $product->category->title ?? '-';
            })
             ->editColumn('sub_category_id', function (Product $product){
                return $product->subCategory->title ?? '-';
            })
            ->editColumn('created_at', function (Product $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->addColumn('action', 'admin.products.datatables_actions')
            ->rawColumns(['status', 'action', 'created_at']);
    }

    public function query(Product $model)
    {
        return $model->newQuery()->with(['category', 'subCategory']);
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
                'order'     => [[count($this->getColumns()) -1 , 'desc']],
                'buttons'   => [],
            ]);
    }

    protected function getColumns()
    {
        return [
            'title',
            'category_id' => ['title' => 'Category'],
            'sub_category_id' => ['title' => 'Sub Category'],
            'status',
            'created_at' => ['title' => 'Added on'],
        ];
    }

    protected function filename() : string
    {
        return 'productsdatatable_' . time();
    }
}
