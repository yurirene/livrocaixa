<?php

namespace App\DataTables;

use App\Models\LivroCaixa;
use App\Models\Pagamento;
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
            ->editColumn('action', function($query) {
                return '<a onclick="deleteRegister(this)" href="javascript:void(0)" data-rota="' . route('registro.delete', $query->id) . '" class="btn btn-danger btn-xs">Apagar</a>';
            })
            ->editColumn('created_at', function($query) {
                return $query->data_lancamento;
            })
            ->editColumn('descricao', function($query) {
                return $query->descricao;
            })
            ->editColumn('valor', function($query) {
                return "R$ " . number_format($query->valor, 2, ",", ".");
            })
            ->editColumn('categoria', function($query) {
                return LivroCaixa::CATEGORIAS[$query->categoria];
            })
            ->editColumn('tipo', function($query) {
                return $query->tipo;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pagamento $model
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
                    ->setTableId('livrocaixa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'desc')
                    ->buttons(
                        Button::make('create')->text("<i class='fas fa-plus'></i> Novo")->class("btn-primary"),
                        Button::make('export')->text("Exportar"),
                        Button::make('print')->text("Imprimir")
                    )
                    ->parameters([ 
                        "language" => [ 
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ] 
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
            Column::make('action')->title('Ações')->searchable(false)->orderable(false),
            Column::make('created_at')->title('Data')->addClass('text-center')->orderable(true),
            Column::make('descricao')->title('Descrição')->addClass('text-left'),
            Column::make('valor')->title('Valor')->addClass('text-right'),
            Column::make('categoria')->title('Comprovante')->addClass('text-left'),
            Column::make('tipo')->title('Tipo')->addClass('text-left'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Registros_' . date('YmdHis');
    }
}