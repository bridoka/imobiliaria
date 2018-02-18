<?php

namespace App\Http\Controllers;

use App\http\Models\ImovelModel;
use App\Http\Requests\ImovelRequest;
use App\Http\Services\ConsultaCepServices;
use App\Http\Services\ImovelServices;
use App\Http\Services\TipoImovelServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImoveisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cadastroimovel/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoImovelServices = new TipoImovelServices();
        $tiposImovel = $tipoImovelServices->getListTipoImovel();
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
        $tipoImovelServices = new TipoImovelServices();
        $tiposImovel = $tipoImovelServices->getListTipoImovel();
        $listaEstados = \Illuminate\Support\Facades\Config::get('sistema.estados');
        $listaTiposContrato = \Illuminate\Support\Facades\Config::get('sistema.tiposContrato');
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

}
