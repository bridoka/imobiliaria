<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

#Grupo de rotas da administração do sistema
Route::prefix('admin')->middleware(['auth'])->group(function () {
    #Rota para consulta de CEP
    Route::post('/imoveis/consultacep', "ImoveisController@consultaCep");

    #Rota para listagem de Imoveis
    Route::post('/imoveis/listaimoveis', "ImoveisController@listaImoveis");

    #Rota para cadastro de imóveis (listagem, cadastro, edição e exclusão)
    Route::resource('/imoveis', "ImoveisController");
    #Rota para tela de importação de XML
    Route::get('/importacaoimoveis', "ImportacaoImovelController@index")->name("importacaoimoveis.index");
    Route::post('/importacaoimoveis/importar', "ImportacaoImovelController@importar")->name("importacaoimoveis.importar");
});
Auth::routes();


