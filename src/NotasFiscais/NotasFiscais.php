<?php 
namespace NfeMail\NotasFiscais;

use \NfeMail\HttpClient;
use NfeMail\HttpRequest;

class NotasFiscais extends HttpRequest
{
    public $uri = '/NotasFiscais';

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

    public function findByPedido($pedido, $page=1, $limit=10)
    {
        return $this->findBy('pedido', $pedido, $page=1, $limit=10);
    }

    public function findByNumero($numero, $page=1, $limit=10)
    {
        return $this->findBy('numero', $numero, $page=1, $limit=10);
    }

    public function findByCpfCnpj($cpfcnpj, $page=1, $limit=10)
    {
        return $this->findBy('cpfcnpj', $cpfcnpj, $page=1, $limit=10);
    }

    /**
     * Retorna uma lista de Notas Fiscais a partir da Situação (status) informado
     * $status
     * 100 - autorizada 
     * 101 - cancelada
     * 301 - denegada (irregularidade fiscal do emitente)
     * 302 - denegada (irregularidade fiscal do destinatário)
     * @see http://www.nfemail.com.br/Manualapi/GETapiNotasFiscaisStatus.htm
    */
    public function findByStatus($status, $page=1, $limit=10)
    {
        return $this->findBy('status', $cpfcnpj, $page=1, $limit=10);
    }

    /**
     * Retorna uma Nota Fiscal a partir do Código Interno no NFeMail
     * @param integer $id Código interno da Nota Fiscal relacionado
     * @see http://www.nfemail.com.br/Manualapi/GETapiNotasFiscaisId.htm
     */
    public function findById($id)
    {
        $data = array(
            'id'  => $id
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
    * Envia um arquivo no padrão TXT da SEFAZ para emissão da Nota Fiscal
    * @see http://www.nfemail.com.br/Manualapi/POSTapiNotasFiscais.htm
    */
    public function enviarArquivoTxt($filePath=null)
    {   
        $data = '='.urlencode(file_get_contents($filePath));

        return $this->getHttpClient()->request($this->getUri(), $data, 'POST');
    }

    public function delete($id)
    {   
        $data = array(
            'id' => $id
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'DELETE');
    }

}