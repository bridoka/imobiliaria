@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tipo de Imóvel</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">Cadastro de Tipo de Imóvel</div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-12 text-left">
                                <label for="codigo">Tipo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="Informe o título do imóvel" placeholder="" maxlength="100">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <div class='row'>
                    <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('tipoimovel.index') }}'" name="btVoltar" id="btVoltar" >
                            <span class="glyphicon glyphicon-triangle-left"></span> Voltar
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('tipoimovel.create') }}'" name="btNovo" id="btNovo" >
                            <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop