<?php
/**
 * Created by PhpStorm.
 * User: EMANUELLE
 * Date: 17/02/2018
 * Time: 14:13
 */

namespace App\Http\Services;

use App\http\Models\ImovelModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class ImovelServices
{
    public function getListImoveis()
    {
        $tipoImovel = TipoImovelModel::all();
        if(isset($tipoImovel)){
            $tipos = $tipoImovel->toArray();
        }
        return $tipos;
    }

    /**
     * store
     *
     * Função responsável por criar um novo registro do imóvel
     * @param Request $request
     */
    public function store(Request $request)
    {
        $imovel = new ImovelModel();
        $imovel->fill($request->all());
        try {
            if ($imovel->save()) {
                $request->session()->flash('messageSuccess', 'Salvo com sucesso!');
                $this->uploadFoto($request,$imovel->id);
            } else {
                $request->session()->flash('messageWarning', 'Não foi possível salvar!');
            }
        } catch (QueryException $e){
            $request->session()->flash('messageWarning', 'Não foi possível salvar!');
        } catch (FatalThrowableError $e){
            $request->session()->flash('messageWarning', 'Não foi possível salvar!');
        }
    }

    /**
     * update
     *
     * Função responsável por atualizar o registro do imóvel
     * @param Request $request
     */
    public function update(Request $request,$id)
    {
        $imovel = ImovelModel::findOrFail($id);
        $imovel->fill($request->all());
        try {
            if ($imovel->save()) {
                $request->session()->flash('messageSuccess', 'Salvo com sucesso!');
                if($request->removeImg == "S") {
                    $this->removeFoto($id);
                }
                if(isset($request->imagem)) {
                    $this->removeFoto($id);
                    $this->uploadFoto($request, $imovel->id);
                }
            } else {
                $request->session()->flash('messageWarning', 'Não foi possível salvar!');
            }
        } catch (QueryException $e){
            $request->session()->flash('messageWarning', 'Não foi possível salvar!');
        } catch (FatalThrowableError $e){
            $request->session()->flash('messageWarning', 'Não foi possível salvar!');
        }
    }

    /**
     * uploadFoto
     *
     * Função responsável por fazer o upload da foto da casa.
     *
     * O diretório onde a foto ficará gravado terá o id do imóvel como nome.
     *
     * @param Request $request
     * @param $id
     */
    public function uploadFoto(Request $request,$id)
    {
        $directory = "public/imagens/$id";
        if(!empty($request->file('imagem'))) {
            $existeDiretorio = Storage::exists("$directory");
            if (!$existeDiretorio) {
                #Se o diretório não existir, será criado neste momento.
                Storage::makeDirectory($directory);
            }
            $foto = $request->file('imagem')->getRealPath();
            $extensao = $request->file('imagem')->guessExtension();
            if (in_array($extensao, array('jpeg', 'png', 'jpg'))) {
                $request->file('imagem')->storeAs($directory, 'foto.' . $extensao);
            }
        }
    }

    /**
     * getNomeImagemDiretorio
     *
     * Retorna o nome da imagem que está no diretório do imovel
     * @param $id
     * @return mixed|string
     */
    public function getNomeImagemDiretorio($id)
    {
        $imagens = Storage::files('public/imagens/'.$id);
        $imgName = "";
        foreach($imagens as $pathImg){
            $dadosDirImg = explode("/",$pathImg);
            $imgName = array_pop($dadosDirImg);
        }
        return $imgName;
    }

    /**
     * removeFoto
     **/
    public function removeFoto($id)
    {
        $directory = 'public/imagens/'.$id;
        Storage::deleteDirectory($directory);
    }

    public function destroy($id)
    {
        $imovel = ImovelModel::findOrFail($id);
        $deleted = $imovel->delete();
        if($deleted) {
            $this->removeFoto($id);
            Session::flash('messageSuccess', 'Excluído com sucesso!');
            return true;
        } else {
            Session::flash('messageWarning', 'Não foi possível excluir!');
            return false;
        }
    }

    /**
     * getTipoImovelId
     *
     * Retorna a descrição do tipo de imovel de acordo com o id enviado no parâmetro.
     * @param $id
     * @return mixed
     */
    public function getTipoImovelId($id)
    {
        $tiposImovel = \Illuminate\Support\Facades\Config::get('sistema.tiposImoveis');
        return $tiposImovel[$id];
    }

    /**
     * getTipoContratoId
     *
     * Retorna a descrição do tipo de contrato de acordo com o id enviado no parâmetro
     * @param $id
     * @return mixed
     */
    public function getTipoContratoId($id)
    {
        $listaTiposContrato = \Illuminate\Support\Facades\Config::get('sistema.tiposContrato');
        return $listaTiposContrato[$id];
    }


    /**
     * Retorna o ID do Tipo de Imovel baseado na descrição
     * @param $tipoImovel
     * @return false|int|string
     */
    public function getIdTipoImovel($tipoImovel)
    {
        $tipoImovel = ucfirst(strtolower($tipoImovel));
        $listaTiposImoveis = \Illuminate\Support\Facades\Config::get('sistema.tiposImoveis');
        return array_search($tipoImovel,$listaTiposImoveis);
    }

    public function listaImoveis(Request $request)
    {
        $numRegPagina = $request->length;
        $currentPage = $request->start + 1;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $searchValue = $request->search['value'];
        if(!empty($request->search['value'])){
            $imoveis = ImovelModel::where("codigo","like","$searchValue%")->paginate($numRegPagina);
        } else {
            $imoveis = ImovelModel::paginate($numRegPagina);
        }
        $countImoveis = $imoveis->total();

        $retorno = array();
        $retorno['draw'] = $request->draw;
        $retorno['recordsTotal'] = $countImoveis;
        $retorno['recordsFiltered'] = $countImoveis;
        $cont = 0;
        foreach($imoveis as $imovel){
            $retorno['data'][$cont][] = $imovel->id;
            $retorno['data'][$cont][] = $imovel->codigo;
            $retorno['data'][$cont][] = $imovel->titulo;
            $retorno['data'][$cont][] = $this->getTipoImovelId($imovel->tipoimovel);
            $retorno['data'][$cont][] = $this->getTipoContratoId($imovel->tipocontrato);
            $retorno['data'][$cont][] = $imovel->valor;
            $nomeImagem = $this->getNomeImagemDiretorio($imovel->id);
            $enderecoImagem = "";
            if($nomeImagem){
                $enderecoImagem = asset("storage/imagens/".$imovel->id."/".$nomeImagem);
            }
            $retorno['data'][$cont][] = $enderecoImagem;
            $cont++;
        }
        return $retorno;
    }
}