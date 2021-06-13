<?php

namespace App\Http\Controllers;

use App\DataTables\LivroCaixaDataTable;
use App\Models\LivroCaixa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroCaixaController extends Controller
{
    public function index(LivroCaixaDataTable $dataTable)
    {
        return $dataTable->render('index');
    }

    public function create()
    {
        return view('novo', ['categorias' => LivroCaixa::CATEGORIAS]);
    }

    public function store(Request $request)
    {
        try {
            LivroCaixa::create($request->except('_token'));
            return redirect()->route('registro.index')->with('message', ['type'=>'success', 'text'=>'Salvo com Sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type'=>'danger', 'text'=> $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $registro = LivroCaixa::find($id);
            $registro->delete();
            return redirect()->back()->with('message', ['type'=>'success', 'text'=>'Apagado com Sucesso!']);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type'=>'danger', 'text'=> $e->getMessage()]);
        }
    }

    public function historico()
    {
        return view('historico');
    }

    public function getHistorico(Request $request)
    {
        $datas = explode(' - ', $request->periodo);
        $periodo_inicial = Carbon::createFromFormat('d/m/Y', $datas[0])->format('Y-m-d');
        $periodo_final = Carbon::createFromFormat('d/m/Y', $datas[1])->format('Y-m-d');
        
        $registros = LivroCaixa::select(DB::raw('categoria, tipo, sum(valor) as valor'))
            ->groupBy('tipo')
            ->groupBy('categoria')
            ->whereDate('created_at', '>=', $periodo_inicial)
            ->whereDate('created_at', '<=', $periodo_final)
            ->get();
        $total = 0;
        foreach ($registros as $registro) {
            if ($registro->tipo == 'Entrada') {
                $total += $registro->valor;
            } else {
                $total -= $registro->valor;
            }
            $registro->valor = number_format($registro->valor, 2, ',', ' ');
            $registro->categoria = LivroCaixa::CATEGORIAS[$registro->categoria];
        }
        $retorno = $registros->toArray();
        $retorno[] = ['categoria' => 'Total Disponível', 'valor' => number_format($total, 2, ',', ' ')];
        return response()->json($retorno);
    }

}
