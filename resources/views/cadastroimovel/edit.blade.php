@extends('adminlte::page')

@section('title', 'Imóvel')

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
            <div class="panel-heading">Edição de Imóvel</div>
            <form action="{{ route('imoveis.update',$imovel->id) }}" name="form" id="form" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {!! csrf_field() !!}
                <div class="panel-body">

                    <div class="form-group">
                        <div class='row'>
                            <div class="col-md-4 text-left">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" value="{{$imovel->codigo}}"
                                       aria-describedby="Informe o código imóvel" placeholder="" size="20"
                                       maxlength="20" required>
                            </div>
                            <div class="col-md-8 text-left">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" value="{{$imovel->titulo}}"
                                       aria-describedby="Informe o título do imóvel" placeholder="" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="tipoimovel_id">Tipo de Imóvel</label>
                                <select class="form-control" name="tipoimovel_id" id="tipoimovel_id" required>
                                    <option value=""></option>
                                    @foreach ($tiposImovel as $tipoImovel)
                                        @if($imovel->tipoimovel_id == $tipoImovel['id'])
                                            <option value="{{$tipoImovel['id']}}" selected>{{$tipoImovel['tipo']}}</option>
                                        @else
                                            <option value="{{$tipoImovel['id']}}">{{$tipoImovel['tipo']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="tipocontrato">Tipo de Contrato</label>
                                <select class="form-control" name="tipocontrato" id="tipocontrato" required>
                                    <option value=""></option>
                                    @foreach ($listaTiposContrato as $tipo=>$descricaoTipo)
                                        @if($imovel->tipocontrato == $tipo)
                                            <option value="{{$tipo}}" selected>{{$descricaoTipo}}</option>
                                        @else
                                            <option value="{{$tipo}}">{{$descricaoTipo}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" name="valor" id="valor" value="{{$imovel->valor}}" aria-describedby="Informe o valor" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="areaimovel">Área (m²)</label>
                                <input type="text" class="form-control" name="areaimovel" id="areaimovel" value="{{$imovel->areaimovel}}" maxlength="11" aria-describedby="Informe o tamanho" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numsalas">Salas</label>
                                <input type="text" class="form-control" name="numsalas" id="numsalas" value="{{$imovel->numsalas}}" maxlength="11" aria-describedby="Informe o número de salas" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numgaragem">Garagem</label>
                                <input type="text" class="form-control" name="numgaragem" id="numgaragem" value="{{$imovel->numgaragem}}" maxlength="11" aria-describedby="Informe o número de vagas na garagem" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="numquartos">Quartos</label>
                                <input type="text" class="form-control" name="numquartos" id="numquartos" value="{{$imovel->numquartos}}" maxlength="11" aria-describedby="Informe o número de quartos" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numsuites">Suítes</label>
                                <input type="text" class="form-control" name="numsuites" id="numsuites" value="{{$imovel->numsuites}}" maxlength="11" aria-describedby="Informe o número de suítes" placeholder="">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="numbanheiros">Banheiros</label>
                                <input type="text" class="form-control" name="numbanheiros" id="numbanheiros" value="{{$imovel->numbanheiros}}" maxlength="11" aria-describedby="Informe o número de banheiros" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-12 text-left">
                                <label for="logradouro">Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$imovel->logradouro}}"
                                       aria-describedby="Informe o logradouro" placeholder="" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero" value="{{$imovel->numero}}"
                                       aria-describedby="Informe o número" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="complemento">Complemento</label>
                                <input type="text" class="form-control" name="complemento" id="complemento" value="{{$imovel->complemento}}"
                                       aria-describedby="Informe o complemento" placeholder="" maxlength="11">
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep" value="{{$imovel->cep}}"
                                       aria-describedby="Informe o cep" placeholder="" maxlength="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class="form-group col-md-4 text-left">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" value="{{$imovel->bairro}}"
                                       aria-describedby="Informe o bairro" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade" value="{{$imovel->cidade}}"
                                       aria-describedby="Informe a cidade" placeholder="" maxlength="11" required>
                            </div>
                            <div class="form-group col-md-4 text-left">
                                <label for="estado">Estado</label>
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value=""></option>
                                    @foreach ($listaEstados as $abrev=>$estado)
                                        @if($imovel->estado == $abrev)
                                            <option value="{{$abrev}}" selected>{{$estado}}</option>
                                        @else
                                            <option value="{{$abrev}}">{{$estado}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-md-6 text-left">
                            <label for="imagem">Carregar imagem</label>
                            <input type="file" class="form-control-file" id="imagem" name="imagem"
                                   aria-describedby="Carregar imagem">
                        </div>
                        @if(!empty($nomeImagem))
                        <div class="form-group col-md-6 text-left">
                            <label for="imagemImp">Imagem Carregada</label>
                            <br>
                            <div class="form-group" >
                                <img name="imagemImp" id="imagemImp" class="img-thumbnail" style="max-width: 50%"  src="{{asset("storage/imagens/".$imovel->id."/".$nomeImagem)}}">
                            </div>
                            <br>
                            <input type="checkbox" class="form-group text-right" name="removeImg" id="removeImg" value="S">Remover Imagem
                        </div>
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <div class='row'>
                        <div class="col-md-6 text-left">

                            <button type="button" class="btn btn-danger"
                                    onclick="Imoveis.remover('{{ route('imoveis.destroy',$imovel->id) }}')"
                                    name="btRemove" id="btRemove">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-secondary"
                                    onclick="window.location='{{ route('imoveis.index') }}'" name="btNovo" id="btNovo">
                                <span class="glyphicon glyphicon-remove"></span> Cancelar
                            </button>
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