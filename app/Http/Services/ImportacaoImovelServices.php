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

class ImportacaoImovelServices
{
    protected $directory = "public/xml";
    protected $fileName = "arquivoXML.xml";

    protected function uploadXML(Request $request)
    {
        $directory = $this->directory;
        if(!empty($request->file('xml'))) {
            $existeDiretorio = Storage::exists("$directory");
            if (!$existeDiretorio) {
                #Se o diretório não existir, será criado neste momento.
                Storage::makeDirectory($directory);
            }
            $foto = $request->file('xml')->getRealPath();
            $extensao = $request->file('xml')->guessExtension();
            $request->file('xml')->storeAs($directory, $this->fileName);
            return true;


        }
        return false;
    }

    /**
     * execute
     *
     * Executa a leitura do xml
     * @param Request $request
     * @return bool
     */
    public function execute(Request $request)
    {
        $upFile = $this->uploadXML($request);
        if($upFile) {
            #Sistema fará a leitura e formatação dos dados do xml
            $importacaoXML = new ImportacaoXML();
            $importacaoXML->setFileXML($this->directory . '/' . $this->fileName);
            $dadosImoveis = $importacaoXML->getDadosImoveisXML();
            foreach ($dadosImoveis as $dadosImovel){
                #Com os dados já formatados, sistema vai inserir os imoveis no banco de dados
                try {
                    $this->storeImovel($dadosImovel);
                } catch (Exception $e){
                    continue;
                }
            }

        }
        return true;
    }

    protected function storeImovel($dadosImovel)
    {
        $imovel = new ImovelModel();
        #Verifica se o imovel já está cadastrado na base para não duplicar o registro.
        $jaCadastrado = $imovel->existeImovelCodigo(trim($dadosImovel['codigo']));
        if(!$jaCadastrado) {
            $imovel->fill($dadosImovel);
            if ($imovel->save()) {
                foreach ($dadosImovel['fotos'] as $foto) {
                    if ($foto['principal']) {
                        $id = $imovel->id;
                        $directory = "public/imagens/$id";
                        $existeDiretorio = Storage::exists("$directory");
                        if (!$existeDiretorio) {
                            #Se o diretório não existir, será criado neste momento.
                            Storage::makeDirectory($directory);
                        }
                        $dadosArq = substr($foto['url'], -3);
                        $dir = dirname(__FILE__)."/../../../storage/app/public/imagens/".$id;
                        copy($foto['url'], $dir.'/foto.'.$dadosArq);
                    }
                }
            }
        }
    }
}