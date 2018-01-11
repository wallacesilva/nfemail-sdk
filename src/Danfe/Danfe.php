<?php 
namespace NfeMail\Danfe;

use \NfeMail\HttpClient;
use NfeMail\HttpRequest;

class Danfe extends HttpRequest
{
    public $uri = '/DANFe';

    public function all($page=1, $limit=10)
    {
        $data = array(
            'page'  => $page,
            'limit' => $limit
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    public function findBy($item, $item_value, $page=1, $limit=10)
    {
        $data = array(
            $item   => $item_value,
            'page'  => $page,
            'limit' => $limit
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna o DANFe da Nota Fiscal a partir da Chave informada
     * @see http://www.nfemail.com.br/Manualapi/GETapiDANFe.htm
     */
    public function findByChave($chave)
    {
        $data = array(
            'chave'  => $chave
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna o DANFe da Nota Fiscal a partir do Número informado
     */
    public function findByNumero($numero)
    {
        $data = array(
            'numero'  => $numero
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna o DANFe da Nota Fiscal a partir do Código do Pedido informado
     * @param $pedido Código do pedido da Nota Fiscal (até 60 caracteres)
     * @see http://www.nfemail.com.br/Manualapi/GETapiDANFepedido.htm
     */
    public function findByPedido($pedido)
    {
        $data = array(
            'pedido'  => $pedido
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Cancela uma Nota Fiscal autorizada a partir do Código Interno no NFeMail
     * @param $id código interno da Nota Fiscal relacionado
     * @param $motivo motivo do cancelamento da nota fiscal (mínimo de 15 caracteres)
     * @see http://www.nfemail.com.br/Manualapi/DELETEapiDANFe.htm
     */
    public function delete($id, $motivo)
    {   
        $data = array(
            'id'        => $id,
            'motivo'    => $motivo
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'DELETE');
    }

}