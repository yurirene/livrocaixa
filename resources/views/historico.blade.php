@extends('template')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        Histórico
        <a href="{{route('registro.index')}}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Selecione o Período</label>
            <input type="text" class="form-control isDateRange" id="periodo"/> 
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" id="route" value="{{route('registro.get-historico')}}" />    
        </div>
        <button class="btn btn-primary mt-3" type="button" id="gerar">Gerar</button>
        <div class="row mt-3">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th class="text-end">Valor</th>
                            </tr>
                        </thead>
                        <tbody id="dados">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#gerar').on('click', function(){
        var url = $('#route').val();
        var _token = $('#token').val();
        var periodo = $('#periodo').val();
        $.ajax({
            url: url,
            type:"POST",
            data:{
                periodo: periodo,
                _token: _token
            },
            success:function(response){

                $('#dados').empty();
                var saida = '';
                response.forEach(item => {
                    saida += '<tr>';
                    saida += "<td class='text-start'>" + item.categoria + '</td>';
                    saida += "<td class='text-end'>R$" + item.valor + '</td>';
                    saida += '</tr>';
                });
                $('#dados').append(saida);
            },
        });
    });
</script>
@endsection