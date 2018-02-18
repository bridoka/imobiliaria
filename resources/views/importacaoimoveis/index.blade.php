@extends('adminlte::page')

@section('title', 'Imóveis')

@section('content_header')
    @if (session('messageSuccess'))
        <div class="alert alert-success" role="alert">{{session('messageSuccess')}}</div>
    @endif
    @if (session('messageWarning'))
        <div class="alert alert-warning" role="alert">{{session('messageWarning')}}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Importação de Imóveis</h1>
@stop

@section('content')
    <form action="{{ route('importacaoimoveis.importar') }}"  name="form" id="form" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="container-fluid">
            <div class="panel panel-warning">
                <div class="panel-heading">Importação de Imóveis via Arquivo XML </div>
                <div class="panel-body">
                    <div class="form-group form-group-file">
                        <label for="imagem">Carregar arquivo XML</label>
                        <input type="file" class="form-control-file" id="xml" name="xml" data-filetype="text/xml" aria-describedby="Carregar xml">
                    </div>
                </div>
                <div class="panel-footer">
                    <div class='row'>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary"
                                    onclick="" name="btImportar" id="btImportar">
                                <span class="glyphicon glyphicon-open"></span> Importar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@section('js')
    <script src="/js/sistema.js" type="application/javascript"></script>
    <script src="/js/importaimoveis.js" type="application/javascript"></script>
@stop