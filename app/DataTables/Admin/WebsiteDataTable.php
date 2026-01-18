<?php

namespace App\DataTables\Admin;

use App\Models\Blog;
use App\Models\Website;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\MyClasses\GeneralHelperFunctions;

class WebsiteDataTable extends DataTable
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
            ->editColumn('created_at', function (Website $website){
                return GeneralHelperFunctions::prepareHtmlDate($website->created_at);
            })
            ->addColumn('image', function (Website $website){
                if($website->type == 'Pet_Adoption_For_grant_recipients'){
                    return '<img class="list-image" style="background: rgba(1, 1, 108, 1); border-radius: 50%; padding: 10px;" src="'.$website->avatarUrl['250'].'">';
                }else{
                    return '<img class="list-image" src="'.$website->avatarUrl['250'].'">';
                }

            })
            ->editColumn('type', function (Website $website){
                return str_replace('_' , ' ', $website->type);
            })

            ->rawColumns(['created_at', 'image', 'action', 'description'])
            ->addColumn('action', 'admin.websites.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Website $websites
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Website $websites)
    {
        return $websites->newQuery();
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
            'image',
            'heading',
            'sub_heading',
            'type',
            'description',
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
        return 'websites_datatable_' . time();
    }
}
