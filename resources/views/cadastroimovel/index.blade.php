@extends('adminlte::page')

@section('title', 'Imóveis')

@section('content_header')
    <h1>Imóveis</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form class="panel panel-warning" action="{{ route('imoveis.index') }}" name="form" id="form" method="POST">
            <div class="panel-heading">Cadastro de Imóveis</div>
            <div class="panel-body">
                    {!! csrf_field() !!}
                    <div class='form-group'>
                        <div class='row'>
                            <div class="col-md-12 text-center">
                                <table class="display" id="tableImoveis">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Tipo do Imóvel</th>
                                        <th scope="col">Tipo do Contrato</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Foto</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="panel-footer">
                <div class='row'>
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary"
                                onclick="window.location='{{ route('imoveis.create') }}'" name="btNovo" id="btNovo">
                            <span class="glyphicon glyphicon-plus-sign"></span> Cadastrar Novo Imóvel
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@section('css')
    <script src="/css/jquery.dataTables.min.css" type="application/javascript"></script>
@stop
@section('js')
    <script src="/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="/js/listaimoveis.js" type="application/javascript"></script>
@stop