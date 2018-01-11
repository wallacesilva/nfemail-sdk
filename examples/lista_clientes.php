<?php 

require_once(__DIR__.'/../autoload.php');

$cnpj = 'cnpj aqui';
$apikey = 'chave de acesso'; 

$nfemail = new \NfeMail\NfeMail($cnpj, $apikey);

# Listar Clientes
$clientes = $nfemail->getClientes();

# Retorna lista com 10 clientes
$response = $clientes->all(1, 10); 

// imprime na tela em forma de array
print_r($response->toArray()); // ou toObject()