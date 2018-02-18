<?php
/**
 * Created by PhpStorm.
 * User: EMANUELLE
 * Date: 18/02/2018
 * Time: 00:59
 */

namespace App\Http\Services;


class ConsultaCepServices
{
    const CEP_SITE = 'http://viacep.com.br/ws/';
    const CEP_FORMATO = 'json';

    protected $cep;

    /**
     * @param mixed $cep
     */
    public function setCep($cep): void
    {
        $this->cep = $cep;
    }

    /**
     * unMaskCep
     *
     * Retira a máscara do CEP
     */
    protected function unMaskCep()
    {
        if(isset($this->cep)) {
            $this->cep = str_replace("-", "", $this->cep);
        }
    }

    /**
     * enviaConsultaCep
     *
     * Envia pedido de consulta de CEP para a API
     * @return mixed
     */
    protected function consultaCepAPI() {
        $cep = $this->cep;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        $url = self::CEP_SITE . $cep ."/".self::CEP_FORMATO."/";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLVERSION,3);
        $retorno = curl_exec($ch);
        curl_close($ch);
        return $retorno;
    }

    /**
     * @return mixed|void
     */
    public function execute()
    {
        if(isset($this->cep)) {
            $this->unMaskCep();
            return $this->consultaCepAPI();
        }
        return;
    }

}