<?php

namespace App\DataTables;

use App\Models\LivroCaixa;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LivroCaixaDataTable extends DataTable
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
            ->addColumn('action', 'livrocaixadatatable.action')
            ->addColumn('Categoria', function($query){
                return LivroCaixa::CATEGORIAS[$query->categoria];
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LivroCaixaDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LivroCaixa $model)
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
                    ->setTableId('livrocaixadatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('Data'),
            Column::make('Descrição'),
            Column::make('Valor'),
            Column::make('Categoria'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LivroCaixa_' . date('YmdHis');
    }
}
