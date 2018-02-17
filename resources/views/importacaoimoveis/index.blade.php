@extends('adminlte::page')

@section('title', 'Imóveis')

@section('content_header')
    <h1>Importação de Imóveis</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">Importação de Imóveis via Arquivo XML </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="imagem">Carregar arquivo XML</label>
                    <input type="file" class="form-control-file" id="imagem" name="imagem" aria-describedby="Carregar imagem">
                </div>
            </div>
            <div class="panel-footer">
                <div class='row'>
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary"
                                onclick="" name="btVoltar" id="btVoltar">
                            <span class="glyphicon glyphicon-open"></span> Importar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="/js/imoveis.js" type="application/javascript"></script>
@stop