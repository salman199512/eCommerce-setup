<?php

namespace App\DataTables\Admin;

use App\Models\AttributeGroup;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AttributeGroupDataTable extends DataTable
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
            ->editColumn('status', function (AttributeGroup $model) {
                if ($model->status == '1') {
                    $status = 'checked';
                    $val = '0';
                } else {
                    $status = '';
                    $val = '1';
                }
                $alert = 'Are you sure?';
                $tableId = 'dataTableBuilder';
                $urlStatus = route('admin.attribute-groups.status-change', $model->uuid) . '?active=' . $val;


                return view('admin.layouts.status', compact('model', 'tableId','status','alert','urlStatus'));

            })
            ->editColumn('created_at', function (AttributeGroup $model){
                return GeneralHelperFunctions::prepareHtmlDate($model->created_at);
            })
            ->addColumn('action', 'admin.attribute_groups.datatables_actions')
            ->rawColumns(['status', 'action', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AttributeGroup $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AttributeGroup $model)
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
            'title',
            'status',
            'created_at' => ['title' => 'Added on'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() : string
    {
        return 'attribute_groupsdatatable_' . time();
    }
}
