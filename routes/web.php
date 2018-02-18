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
    #Rota para cadastro de tipo de imóvel
    Route::resource('/tipoimovel', "TipoImovelController");
    #Rota para cadastro de imóveis (listagem, cadastro, edição e exclusão)
    Route::post('/imoveis/consultacep', "ImoveisController@consultaCep");
    Route::resource('/imoveis', "ImoveisController");
    #Rota para tela de importação de XML
    Route::resource('/importacaoimoveis', "ImportacaoImovelController");
});
Auth::routes();


