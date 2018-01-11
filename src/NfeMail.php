<?php 
namespace NfeMail;

use \NfeMail\HttpClient;
use \NfeMail\Clientes\Clientes;
use \NfeMail\Danfe\Danfe;
use \NfeMail\NotasFiscais\NotasFiscais;
use \NfeMail\Produtos\Produtos;

class NfeMail
{
    /**
     * Array de configuracoes padroes
     */
    private $config;

    /**
     * Instancia de \NfeMail\HttpClient para trabalhar os requests
     */
    private $httpClient;

    /**
     * Instancia de \NfeMail\Danfe\Danfe
     */
    private $danfe;

    /**
     * Instancia de \NfeMail\Clientes\Clientes
     */
    private $clientes;

    /**
     * Instancia de \NfeMail\NotasFiscais\NotasFiscais
     */
    private $notasfiscais;

    /**
     * Instancia de \NfeMail\Produtos\Produtos
     */
    private $produtos;

    /**
     * 
     */
    public function __construct($cnpj, $apikey, $config=array())
    {
        $config_auth = array(
            'auth' => array(
                'cnpj'   => $cnpj, 
                'apikey' => $apikey
            )
        );

        $config = array_merge($config, $config_auth);

        $this->setConfig($config);
    }

    /**
     * Define array de configuracoes
     */
    public function setConfig($config)
    {
        $default = $this->getConfig();

        $config = array_merge($default, $config);

        $this->config = $config;

        return $this;
    }

    /**
     * Retorna array de configuracoes
     */
    public function getConfig()
    {
        $default = array(
            'env'       => 'production',
            'apiUrl'    => 'https://api.nfemail.com.br/api/',
            'apiVersion'=> '1',
            'auth'      => array('cnpj' => null, 'apikey' => null) // required
        );

        return is_array($this->config) ? $this->config : $default;
    }

    /**
     * Retorna instancia de \NfeMail\HttpClient
     */
    public function getHttpClient()
    {
        if ($this->httpClient instanceof HttpClient) {


        } else {

            $this->httpClient = new HttpClient($this->getConfig());

        }

        return $this->httpClient;
    }

    /**
     * Retorna instancia de \NfeMail\Clientes\Clientes
     */
    public function getClientes()
    {
        return ($this->clientes instanceof Clientes) ? $this->clientes : (new Clientes($this));
    }

    /**
     * Retorna instancia de \NfeMail\Danfe\Danfe
     */
    public function getDanfe()
    {
        return ($this->danfe instanceof Danfe) ? $this->danfe : (new Danfe($this));
    }

    /**
     * Retorna instancia de \NfeMail\NotasFiscais\NotasFiscais
     */
    public function getNotasFiscais()
    {
        return ($this->notasfiscais instanceof NotasFiscais) ? $this->notasfiscais : (new NotasFiscais($this));
    }

    /**
     * Retorna instancia de \NfeMail\Produtos\Produtos
     */
    public function getProdutos()
    {
        return ($this->produtos instanceof Produtos) ? $this->produtos : (new Produtos($this));
    }
}