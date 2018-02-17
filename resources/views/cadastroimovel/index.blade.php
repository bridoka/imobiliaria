@extends('adminlte::page')

@section('title', 'Imóveis')

@section('content_header')
    <h1>Imóveis</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">Cadastro de Imóveis</div>
            <div class="panel-body">
                <div class='row'>
                    <div class="col-md-12 text-center">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Título</th>
                                <th scope="col">Tipo do Imóvel</th>
                                <th scope="col">Tipo do Contrato</th>
                                <th scope="col">Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class='row'>
                    <div class="col-md-12 text-center">
                        <ul class="pagination">
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
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
        </div>
    </div>
@stop
@section('js')
    <script src="/js/imoveis.js" type="application/javascript"></script>
@stop