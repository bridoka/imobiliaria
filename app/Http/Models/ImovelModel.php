<?php

namespace App\http\Models;

use Illuminate\Database\Eloquent\Model;

class ImovelModel extends Model
{
    protected $table = 'imoveis';
    protected $fillable = ["codigo","titulo","tipoimovel_id",
                           "tipocontrato" , "areaimovel","valor",
                           "logradouro","numero", "complemento",
                           "cep","bairro", "cidade", "estado",
                           "numquartos","numsalas","numsuites",
                           "numbanheiros","numgaragem"
    ];

    public function setCepAttribute($value)
    {
        $this->attributes['cep'] = str_replace("-","",$value);
    }

    public function setValorAttribute($value)
    {
        if(isset($value )) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
            $this->attributes['valor'] = number_format($value, 2, '.', '');
        }
    }

    public function getValorAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
