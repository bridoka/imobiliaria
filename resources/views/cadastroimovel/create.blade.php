@extends('adminlte::page')

@section('title', 'Dashboard')

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
@stop

@section('content')
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">Cadastro de Imóveis</div>
            <form action="{{ route('imoveis.store') }}" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="POST">
                {!! csrf_field() !!}
                <div class="panel-body">

                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo"
                                       aria-describedby="Informe o código imóvel" placeholder="" size="20"
                                       maxlength="20" required>
                            </div>
                            <div class="col-md-8 text-left">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo"
                                       aria-describedby="Informe o título do imóvel" placeholder="" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="tipoimovel_id">Tipo de Imóvel</label>
                                <select class="form-control" name="tipoimovel" id="tipoimovel" required>
                                    <option value=""></option>
                                    @foreach ($tiposImovel as $tipo => $tipoImovel)
                                        <option value="{{$tipo}}">{{$tipoImovel}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="tipocontrato">Tipo de Contrato</label>
                                <select class="form-control" name="tipocontrato" id="tipocontrato" required>
                                    <option value=""></option>
                                    @foreach ($listaTiposContrato as $tipo=>$descricaoTipo)
                                        <option value="{{$tipo}}">{{$descricaoTipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" name="valor" id="valor" aria-describedby="Informe o valor" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="areaimovel">Área (m²)</label>
                                <input type="text" class="form-control" name="areaimovel" id="areaimovel" maxlength="11" aria-describedby="Informe o tamanho" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numsalas">Salas</label>
                                <input type="text" class="form-control" name="numsalas" id="numsalas" maxlength="11" aria-describedby="Informe o número de salas" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numgaragem">Garagem</label>
                                <input type="text" class="form-control" name="numgaragem" id="numgaragem" maxlength="11" aria-describedby="Informe o número de vagas na garagem" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="numquartos">Quartos</label>
                                <input type="text" class="form-control" name="numquartos" id="numquartos" maxlength="11" aria-describedby="Informe o número de quartos" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numsuites">Suítes</label>
                                <input type="text" class="form-control" name="numsuites" id="numsuites" maxlength="11" aria-describedby="Informe o número de suítes" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numbanheiros">Banheiros</label>
                                <input type="text" class="form-control" name="numbanheiros" id="numbanheiros" maxlength="11" aria-describedby="Informe o número de banheiros" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-12 text-left">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" id="logradouro"
                                       aria-describedby="Informe o logradouro" placeholder="" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero"
                                       aria-describedby="Informe o número" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento" id="complemento"
                                       aria-describedby="Informe o complemento" placeholder="" maxlength="11">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep"
                                       aria-describedby="Informe o cep" placeholder="" maxlength="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro"
                                       aria-describedby="Informe o bairro" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade"
                                       aria-describedby="Informe a cidade" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="estado">Estado</label>
                                <select class="form-control" name="estado" id="estado" required>
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
                        <input type="file" class="form-control-file" id="imagem" name="imagem"
                               aria-describedby="Carregar imagem">
                    </div>
                </div>
                <div class="panel-footer">
                    <div class='row'>
                        <div class="col-md-6 text-left">
                            <button type="button" class="btn btn-secondary"
                                    onclick="window.location='{{ route('imoveis.index') }}'" name="btNovo" id="btNovo">
                                <span class="glyphicon glyphicon-triangle-left"></span> Voltar
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary" name="btSave" id="btSave">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@section('js')

    <script src="/js/sistema.js" type="application/javascript"></script>
    <script src="/js/imoveis.js" type="application/javascript"></script>
@stop