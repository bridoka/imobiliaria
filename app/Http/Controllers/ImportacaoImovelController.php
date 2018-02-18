<?php

namespace App\Http\Controllers;

use App\Http\Services\ImportacaoImovelServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ImportacaoImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('importacaoimoveis/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importar(Request $request)
    {
        $importacaoImovelServices = new ImportacaoImovelServices();
        $retistrosImportados = $importacaoImovelServices->execute($request);
        if($retistrosImportados){
            Session::flash('messageSuccess', 'Importado com sucesso!');
            return Redirect::to('admin/importacaoimoveis');
        }
    }

}
