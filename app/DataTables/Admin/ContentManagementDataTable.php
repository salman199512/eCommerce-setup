<?php

namespace App\DataTables\Admin;

use App\Models\ContentManagement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\MyClasses\GeneralHelperFunctions;

class ContentManagementDataTable extends DataTable
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
            ->editColumn('created_at', function (ContentManagement $contentManagement){
                return GeneralHelperFunctions::prepareHtmlDate($contentManagement->created_at);
            })
            ->editColumn('updated_at', function (ContentManagement $contentManagement){
                return GeneralHelperFunctions::prepareHtmlDate($contentManagement->updated_at);
            })
            ->editColumn('active', function (ContentManagement $model) {
                if ($model->active == '1') {
                    $status = 'checked';
                    $val = '0';
                } else {
                    $status = '';
                    $val = '1';
                }
                $alert = 'Are you sure?';
                $tableId = 'dataTableBuilder';
                $urlStatus = route('admin.contentManagements.status-change', $model->uuid) . '?active=' . $val;


                return view('admin.layouts.status', compact('model', 'tableId','status','alert','urlStatus'));

            })
            ->rawColumns(['created_at', 'updated_at', 'action', 'active'])
            ->addColumn('action', 'admin.content_managements.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContentManagement $content_managements
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContentManagement $content_managements)
    {
        return $content_managements->newQuery();
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
                'dom'       => 'B<\'row p-t-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
            ],
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
            'active',
            'created_at' => ['title' => 'Added on'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'content_managements_datatable_' . time();
    }
}
