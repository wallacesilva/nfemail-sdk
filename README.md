# NfeMail SDK - Não oficial

Essa é uma biblioteca, não oficial, para acessar facilmente a API do [http://www.nfemail.com.br](http://www.nfemail.com.br). Para acessar a api você precisa de uma chave de acesso e para isso entre em contato com suporte que irão disponibilizar para você.

## Instalação

### Metodo 1 - Usando o Composer

Quem quiser pode usar composer para facilitar o trabalho e basta executar:

```
composer require wallacesilva/nfemail-sdk
```

### Metodo 2 - Manual

Baixe ou clone o repositorio completo. Depois adicione(require) o arquivo autoload.php no seu projeto. [Faça o download aqui](https://github.com/wallacesilva/nfemail-sdk/archive/master.zip)

```
<?php 
# informe o caminho para o projeto corretamente, se necessário
require_once(__DIR__.'/nfemail-sdk/autoload.php');
```

## Requisitos

* PHP 5.4+ (sugerido 7.1+)

## Como usar 

Para usar é simples basta chamar uma instancia e fazer os request. Veja abaixo exemplos básicos, para mais exemplos veja na pasta de exemplos em `examples/`.

### Chamar instancia principal
```
<?php
$cnpj = 'cnpj aqui';
$apikey = 'chave de acesso'; 
$nfemail = new \NfeMail\NfeMail($cnpj, $apikey);
?>
```

### Listar Clientes
```
$clientes = $nfemail->getClientes();

# Retorna lista com 10 clientes
$clientes->all(1, 10)->toArray();

# Retorna o cliente encontrado pelo id
#$clientes->findById(45)->toArray();

# Retorna o cliente encontrado pelo Cpf/Cnpj
#$clientes->findByCpfCnpj(12345678912)->toArray();
```

## Exemplos

Caso tenha dúvidas e queira ver formas de usar essa SDK acesse a pasta `examples` que contem alguns exemplos de uso.

## Dúvidas e Problemas

Caso tenha problemas e/ou dúvidas crie uma nova issue aqui (https://github.com/wallacesilva/nfemail-sdk/issues)

## TODO

Aqui algumas coisas que precisa ser feito e você pode ajudar com um pull request.

- Criar Provider para usar no Laravel/Lumen Framework;
- Adicionar mais exemplos de consumo da api;
- Criar testes básicos;
- Add projeto no packagist/composer;

## Versionamento

O ideal é trabalhar com o padrão SEMVER, muito comum no mundo de software e linux, porém essa é uma versão por enquanto, caso não conheça saiba mais em (http://semver.org/).

## Licença

A linceça desse projeto é a MIT License, por favor, verifique se isso interfere na politica da sua empresa, antes de usar o projeto.
