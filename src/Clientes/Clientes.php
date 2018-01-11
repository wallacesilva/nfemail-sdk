<?php 
namespace NfeMail\Clientes;

use \NfeMail\HttpClient;
use NfeMail\HttpRequest;

class Clientes extends HttpRequest
{
    public $uri = '/Clientes';

    /**
     * Retorna uma lista de Clientes/Destinatários
     * @see http://www.nfemail.com.br/Manualapi/GETapiClientes.htm
     */
    public function all($page=1, $limit=10)
    {
        $data = array(
            'page'  => $page,
            'limit' => $limit
        );
        
        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna um Cliente a partir do Código Interno do NFeMail informado
     * @see http://www.nfemail.com.br/Manualapi/GETapiClientesId.htm
     */
    public function findById($id)
    {
        $data = array(
            'id'  => $id
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna um Cliente a partir do CPF/CNPJ informado
     * @see http://www.nfemail.com.br/Manualapi/GETapiClientesCpfcnpj.htm
     */
    public function findByCpfCnpj($cpfcnpj)
    {
        $data = array(
            'cpfcnpj'  => $cpfcnpj
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }
}