@extends('template')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        Registro
        <a href="{{route('registro.create')}}" class="btn btn-secondary">Novo</a>
    </div>
    <div class="card-body">
        <div class="table table-responsive">
            {!! $dataTable->table() !!}                      
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection