<?php 

require_once(__DIR__.'/../autoload.php');

$cnpj = 'cnpj aqui';
$apikey = 'chave de acesso'; 

$nfemail = new \NfeMail\NfeMail($cnpj, $apikey);

# Listar Produtos
$produtos = $nfemail->getProdutos();

# Retorna lista com 10 produtos
$response = $produtos->all(1, 10); 

// imprime na tela em forma de array
print_r($response->toArray()); // ou toObject()