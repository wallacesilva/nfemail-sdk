<?php 
namespace NfeMail;

class Response
{
    /**
     * Retorno do Request em CURL
     */
    private $response;

    /**
     * Array de string de erros encontrados
     */
    private $errors;

    /**
     *
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Verifica se tem erros
     */
    public function hasErrors()
    {
        $response = $this->getResponse();

        $this->errors[] = isset($response['Message']) ? $response['Message'] : array();

        if (count($this->errors) < 1) {
            
            $this->toObject();

        }

        return count($this->errors) > 0;
    }

    /**
     * Retorna array com todos erros encontrados
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Retorna response do request em Curl
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Converte a resposta Json do Request em Array
     */
    public function toArray()
    {
        return $this->toObject(true);
    }

    /**
     * Converte a resposta Json do Request em Objeto
     */
    public function toObject($toArray = false)
    {
        $object = null;
        
        try {

            $object = json_decode($this->getResponse(), $toArray);
            
        } catch (Exception $e) {

            $this->errors[] = 'Response is not a Json';

            $object = array('Message' => $this->getResponse());

            if (!$toArray) 
                $object = json_decode(json_encode($object));
            
        }

        return $object;
    }
}