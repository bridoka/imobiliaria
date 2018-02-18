<?php

namespace App\Http\Controllers;

use App\http\Models\ImovelModel;
use App\Http\Requests\ImovelRequest;
use App\Http\Services\ConsultaCepServices;
use App\Http\Services\ImovelServices;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class ImoveisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numRegPagina = 1;
        $imoveis = ImovelModel::paginate($numRegPagina);
        $currentPage = $imoveis->currentPage();
        $countImoveis = $imoveis->total();
        $paginas = ceil($countImoveis / $numRegPagina);
        return view('cadastroimovel/index')->with('currentPage',$currentPage)
                                                ->with('countImoveis',$countImoveis)
                                                ->with('paginas',$paginas)
                                                ->with('imoveis',$imoveis);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposImovel = \Illuminate\Support\Facades\Config::get('sistema.tiposImoveis');
        $listaEstados = \Illuminate\Support\Facades\Config::get('sistema.estados');
        $listaTiposContrato = \Illuminate\Support\Facades\Config::get('sistema.tiposContrato');
        return view('cadastroimovel/create')->with('tiposImovel',$tiposImovel)
                                                  ->with('listaEstados',$listaEstados)
                                                  ->with('listaTiposContrato',$listaTiposContrato);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImovelRequest $request)
    {
        $imovelServices = new ImovelServices();
        $imovelServices->store($request);
        return Redirect::to('admin/imoveis/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imovel = ImovelModel::findOrFail($id);
        $imovelServices = new ImovelServices();
        $listaEstados = \Illuminate\Support\Facades\Config::get('sistema.estados');
        $listaTiposContrato = \Illuminate\Support\Facades\Config::get('sistema.tiposContrato');
        $tiposImovel= \Illuminate\Support\Facades\Config::get('sistema.tiposImoveis');
        $nomeImagem = $imovelServices->getNomeImagemDiretorio($id);
        return view('cadastroimovel/edit')->with('tiposImovel',$tiposImovel)
                                                ->with('listaEstados',$listaEstados)
                                                ->with('listaTiposContrato',$listaTiposContrato)
                                                ->with('imovel',$imovel)
                                                ->with('nomeImagem',$nomeImagem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imovelServices = new ImovelServices();
        $imovelServices->update($request,$id);
        return Redirect::to('admin/imoveis/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imovelServices = new ImovelServices();
        if($imovelServices->destroy($id)){
            return Redirect::to('admin/imoveis');
        }
    }

    /**
     * Consulta de CEP
     * @param Request $request
     * @return bool|mixed
     */
    public function consultaCep(Request $request)
    {
        $consultaCepServices = new ConsultaCepServices();
        $consultaCepServices->setCep($request->cep);
        $consulta = $consultaCepServices->execute();
        return $consulta;
    }

    public function listaImoveis(Request $request)
    {
        $imovelServices = new ImovelServices();
        $retorno = $imovelServices->listaImoveis($request);
        return json_encode($retorno);
    }

}
