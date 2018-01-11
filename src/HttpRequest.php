<?php 
namespace NfeMail;

use \NfeMail\HttpClient;

class HttpRequest
{
    /**
     * Uri para usar na url da API
     */
    public $uri;

    /**
     * Instancia de \NfeMail\HttpClient para trabalhar os requests
     */
    private $httpClient;
    
    /**
     * Instanica de \NfeMail\NfeMail
     */
    private $nfemail;

    /**
     * @param \NfeMail\NfeMail $nfemail Instanica de NfeMail
     */
    public function __construct($nfemail)
    {
        $this->nfemail = $nfemail;
    }

    /**
     * Retorna a uri definida
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Retorna uma instancia de \NfeMail\HttpClient para trabalhar os requests
     */
    public function getHttpClient()
    {
        if ($this->httpClient instanceof HttpClient) {


        } else {

            $this->httpClient = new HttpClient($this->nfemail->getConfig());

        }

        return $this->httpClient;
    }
}