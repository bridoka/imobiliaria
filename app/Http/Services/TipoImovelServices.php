<?php
/**
 * Created by PhpStorm.
 * User: EMANUELLE
 * Date: 17/02/2018
 * Time: 14:13
 */

namespace App\Http\Services;


use App\http\Models\TipoImovelModel;

class TipoImovelServices
{
    public function getListTipoImovel()
    {
        $tipoImovel = TipoImovelModel::all();
        if(isset($tipoImovel)){
            $tipos = $tipoImovel->toArray();
        }
        return $tipos;
    }
}