<?php

namespace App\Http\Controllers;

use App\DataTables\LivroCaixaDataTable;
use App\Models\LivroCaixa;
use Exception;
use Illuminate\Http\Request;

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
            return redirect()->back()->with('message', ['type'=>'success', 'text'=>'Salvo com Sucesso!']);
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

}
