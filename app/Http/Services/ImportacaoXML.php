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

class ImportacaoXML
{
    protected $fileXML;
    protected $dadosImoveis;

    public function __construct()
    {
        $this->dadosImoveis = array();
        $this->fileXML = "";
    }

    /**
     * @param mixed $fileXML
     */
    public function setFileXML($fileXML): void
    {
        $this->fileXML = $fileXML;
    }

    protected function lerXML()
    {
        $data = Storage::get($this->fileXML); //file_get_contents();
        $xml = simplexml_load_string($data,null,LIBXML_NOCDATA);
        $imoveis = ((array)$xml->Imoveis);
        $id = 0;
        foreach($imoveis["Imovel"] as $imoveis) {
            $this->formataDadosImoveis((array)$imoveis,$id);
            $id++;
        }
        return $id;
    }


    protected function getIdTipoImovel($tipoImovel)
    {
        $imovelService = new ImovelServices();
        return $imovelService->getIdTipoImovel($tipoImovel);
    }

    protected function formataDadosImoveis ($imovel,$id): void
    {
        $this->dadosImoveis[$id]["codigo"] = (string)$imovel['CodigoImovel'];
        $this->dadosImoveis[$id]["tipoimovel"] = (string)$imovel['TipoImovel'];
        $this->dadosImoveis[$id]["cidade"] = (string)$imovel['Cidade'];
        $this->dadosImoveis[$id]["estado"] = (string)$imovel['UF'];
        $this->dadosImoveis[$id]["bairro"] = (string)$imovel['Bairro'];
        $this->dadosImoveis[$id]["numero"] = (int)$imovel['Numero'];
        $this->dadosImoveis[$id]["complemento"] = (string)$imovel['Complemento'];
        $this->dadosImoveis[$id]["cep"] = (string)$imovel['CEP'];
        $this->dadosImoveis[$id]["tipoimovel"] = $this->getIdTipoImovel((string)$imovel['TipoImovel']);
        $this->dadosImoveis[$id]["areaimovel"] = (int)$imovel['AreaTotal'];
        $this->dadosImoveis[$id]["numquartos"] = (int)$imovel['QtdDormitorios'];
        $this->dadosImoveis[$id]["numsuites"] = (int)$imovel['QtdSuites'];
        $this->dadosImoveis[$id]["numsalas"] = (int)$imovel['QtdSalas'];
        $this->dadosImoveis[$id]["numbanheiros"] = (int)$imovel['QtdBanheiros'];
        $this->dadosImoveis[$id]["numvagas"] = (int)$imovel['QtdVagas'];
        $this->dadosImoveis[$id]["titulo"] = (string)$imovel['SubTipoImovel'];
        if($imovel['PrecoVenda'] > 0){
            $this->dadosImoveis[$id]["tipocontrato"] = "V";
            $this->dadosImoveis[$id]["valor"] = $imovel['PrecoVenda'];
        } else if($imovel['PrecoLocacao'] > 0){
            $this->dadosImoveis[$id]["tipocontrato"] = "A";
            $this->dadosImoveis[$id]["valor"] = $imovel['PrecoLocacao'];
        } else if($imovel['PrecoLocacaoTemporada'] > 0){
            $this->dadosImoveis[$id]["tipocontrato"] = "T";
            $this->dadosImoveis[$id]["valor"] = $imovel['PrecoLocacaoTemporada'];
        }
        $fotos = (array)$imovel['Fotos'];
        $contaFoto = 0;
        foreach($fotos['Foto'] as $foto){
            $foto = (array)$foto;
            $this->dadosImoveis[$id]['fotos'][$contaFoto]['url'] = (string)($foto['URLArquivo']);
            $this->dadosImoveis[$id]['fotos'][$contaFoto]['principal'] = (string)($foto['Principal']);
            $contaFoto++;
        }
    }

    public function getDadosImoveisXML() {
        $totalRegistrosLidos = $this->lerXML();
        if($totalRegistrosLidos > 0){
            return $this->dadosImoveis;
        }
        return;
    }

}