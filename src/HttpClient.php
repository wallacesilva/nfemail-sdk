<?php 
namespace NfeMail;

class HttpClient
{
    private $env;
    private $apiUrl;
    private $apiVersion;
    private $auth;
    private $transport;
    private $caBundle;
    private $response;

    public function __construct($config=null)
    {
        $this->setConfig($config);
    }

    public function setConfig($config=null)
    {
        // 
        if (is_array($config) && !empty($config)) {

            $default = array(
                'env'       => 'production',
                'apiUrl'    => 'https://api.nfemail.com.br/api/',
                'apiVersion'=> '1',
                'auth'      => array('cnpj', 'apikey')
            );

            $config = array_merge($default, $config);

            $this->env = $config['env'];
            $this->apiUrl = $config['apiUrl'];
            $this->apiVersion = $config['apiVersion'];
            $this->auth = $config['auth'];

        }

        return $this;
    }

    public function getUrl($uri, $params=null)
    {
        return $this->apiUrl . rtrim($uri, '/') . (is_array($params) ? '?'.http_build_query($params) : '');
    }

    public function getAuthString()
    {
        if (!isset($this->auth['cnpj'])) {
        
            throw new Exception("CNPJ is not defined.", 1);

        } 

        if (!isset($this->auth['apikey'])) {
            
            throw new Exception("APIKEY is not defined.", 1);

        }

        return $this->auth['cnpj'].':'.$this->auth['apikey'];
    }

    public function request($uri, $data=null, $method='GET')
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $this->getUrl($uri, $data));
        
        if ($method!='GET'){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }

        switch ($method) {
            
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 2);
                if ($data){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            
        }

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->getAuthString());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($curl);

        curl_close($curl);

        return new Response($response);
    }
}