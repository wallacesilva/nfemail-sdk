<?php 

require_once(__DIR__.'/../autoload.php');

$cnpj = '25079919000143';
$apikey = 'Vzk0gtXBnaVbaFxrRoTffvuT4YO6gQ69gcv1QUQ'; 

$nfemail = new \NfeMail\NfeMail($cnpj, $apikey);

# Listar Notas Fiscais
$notas = $nfemail->getNotasFiscais();

# Retorna lista com 10 notas
$response = $notas->all(1, 10); 

print_r($response->toArray()['ListaNotaFiscal'][0]['nfe_numero']);

// imprime na tela em forma de array
print_r($response->toArray()); // ou toObject()