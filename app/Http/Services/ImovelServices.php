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
        $existeDiretorio = Storage::exists("$directory");
        if(!$existeDiretorio) {
            #Se o diretório não existir, será criado neste momento.
            Storage::makeDirectory($directory);
        }
        $foto = $request->file('imagem')->getRealPath();
        $extensao = $request->file('imagem')->guessExtension();
        if(in_array($extensao, array('jpeg','png','jpg'))) {
            $request->file('imagem')->storeAs($directory, 'foto.' . $extensao);
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
}