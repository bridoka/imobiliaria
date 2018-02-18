<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImovelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "codigo" => "required|unique:imoveis|max:20",
            "titulo" => "required|max:100",
            "tipoimovel_id" =>"required",
            "tipocontrato" => "required|max:1",
            "logradouro" => "required|max:100",
            "numero" => "required",
            "complemento" => "max:100",
            "cep" => "required|max:10",
            "bairro" => "required|max:100",
            "cidade" => "required|max:100",
            "estado" => "required|max:2"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O :attribute campo é requerido.',
            'unique' => 'O :attribute já está sendo utilizado.'
        ];
    }

    public function attributes()
    {
        return [
            "codigo" => "Código",
            "titulo" => "Título",
            "tipoimovel_id" =>"Tipo do Imóvel",
            "tipocontrato" => "Tipo de Contrato",
            "logradouro" => "Logradouro",
            "numero" => "Número",
            "complemento" => "Complemento",
            "cep" => "CEP",
            "bairro" => "Bairro",
            "cidade" => "Cidade",
            "estado" => "Estado"
        ];
    }
}
