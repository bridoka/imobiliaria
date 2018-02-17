@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Imóveis</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">Cadastro de Imóveis</div>
            <div class="panel-body">
                <form name="form" id="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" aria-describedby="Informe o código imóvel" placeholder="" size="20" maxlength="20">
                            </div>
                            <div class="col-md-8 text-left">
                                <label for="codigo">Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="Informe o título do imóvel" placeholder="" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-6 text-left">
                                <label for="codigo">Tipo de Imóvel</label>
                                <select class="form-control" name="tipoimovel_id" id="tipoimovel_id">
                                    <option value=""></option>
                                    @foreach ($tiposImovel as $tipoImovel)
                                        <option value="{{$tipoImovel['id']}}">{{$tipoImovel['tipo']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 text-left">
                                <label for="codigo">Tipo de Contrato</label>
                                <select class="form-control" name="tipocontrato" id="tipocontrato">
                                    <option value=""></option>
                                    <option value="V">Venda</option>
                                    <option value="L">Locação</option>
                                    <option value="T">Temporada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-6 text-left">
                                <label for="codigo">Tamanho(m²)</label>
                                <input type="text" class="form-control" name="tamanho" id="tamanho" aria-describedby="Informe o tamanho" placeholder="">
                            </div>
                            <div class="col-md-6 text-left">
                                <label for="codigo">Valor</label>
                                <input type="text" class="form-control" name="valor" id="valor" aria-describedby="Informe o valor" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-12 text-left">
                                <label for="codigo">Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" id="logradouro" aria-describedby="Informe o logradouro" placeholder="" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero" aria-describedby="Informe o número" placeholder="" maxlength="11">
                            </div>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Complemento</label>
                                <input type="text" class="form-control" name="complemento" id="complemento" aria-describedby="Informe o complemento" placeholder="" maxlength="11">
                            </div>
                            <div class="col-md-4 text-left">
                                <label for="codigo">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep" aria-describedby="Informe o cep" placeholder="" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" aria-describedby="Informe o bairro" placeholder="" maxlength="11">
                            </div>
                            <div class="col-md-4 text-left">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade" aria-describedby="Informe a cidade" placeholder="" maxlength="11">
                            </div>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value=""></option>
                                    @foreach ($listaEstados as $abrev=>$estado)
                                        <option value="{{$abrev}}">{{$estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Carregar imagem</label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem" aria-describedby="Carregar imagem">
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <div class='row'>
                    <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('imoveis.index') }}'" name="btNovo" id="btNovo" >
                            <span class="glyphicon glyphicon-triangle-left"></span> Voltar
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('imoveis.create') }}'" name="btNovo" id="btNovo" >
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