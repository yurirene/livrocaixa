@extends('template')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        Novo Registro
        <a href="{{route('registro.index')}}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card-body">
        @include('alerts')
        <form action="{{route('registro.store')}}" method="post">
            @csrf
            <div class="form-inline">
                <input type="radio" class="btn-check" value="Entrada" name="tipo" id="entrada" autocomplete="off" >
                <label class="btn btn-outline-success" for="entrada">Entrada</label>

                <input type="radio" class="btn-check" value="Saida" name="tipo" id="saida" autocomplete="off" checked>
                <label class="btn btn-outline-danger" for="saida">Saída</label>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <input class="form-control" type="text" name="descricao" placeholder="Descrição">
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input class="form-control isMoney" type="text" name="valor" placeholder="Valor">
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select  class="form-control" name="categoria">
                    @foreach($categorias as $id => $categoria)
                    <option value="{{$id}}">{{$categoria}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success mt-3" type="submit">Salvar</button>
        </form> 
    </div>
</div>
@endsection