<?php 
namespace NfeMail\Produtos;

use \NfeMail\HttpClient;
use NfeMail\HttpRequest;

class Produtos extends HttpRequest
{
    public $uri = '/Produtos';

    /**
     * Retorna uma lista de Produtos
     * @see http://www.nfemail.com.br/Manualapi/GETapiProdutos.htm
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
     * Retorna um Produto a partir do Código Interno do NFeMail informado
     * @see http://www.nfemail.com.br/Manualapi/GETapiProdutosId.htm
     */
    public function findById($id)
    {
        $data = array(
            'id'  => $id
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }

    /**
     * Retorna um Produto a partir do Código Alternativo (sistema externo) informado
     * @see http://www.nfemail.com.br/Manualapi/GETapiProdutosAlternativo.htm
     */
    public function findByAlternativo($alternativo, $page=1, $limit=10)
    {
        $data = array(
            'alternativo'  => $alternativo,
            'page'         => $page,
            'limit'        => $limit
        );

        return $this->getHttpClient()->request($this->getUri(), $data, 'GET');
    }
}