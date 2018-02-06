<?php 
require_once(__DIR__.'/../autoload.php');

$cnpj = 'cnpj aqui';
$apikey = 'chave de acesso'; 

$nfemail = new \NfeMail\NfeMail($cnpj, $apikey);

$gerarXml = new NfeMail\Gerador\Xml;

$gerarXml->Id = 'NFe00000000000000000000000000000000000000000000';

$gerarXml->ide = (object) [
    'cUF' => 33,
    'cNF' => '0000001',
    'natOp' => 'NATUREZA DA OPERA&#xC7;&#xC3;O',
    'indPag' => '0',
    'mod' => '55',
    'serie' => '1',
    'nNF' => '1',
    'dhEmi' => '2015-10-02T11:50:46-03:00',
    'tpNF' => '1',
    'idDest' => '1',
    'cMunFG' => '3304557',
    'tpImp' => '1',
    'tpEmis' => '1',
    'cDV' => '0',
    'tpAmb' => '1',
    'finNFe' => '1',
    'indFinal' => '0',
    'indPres' => '9',
    'procEmi' => '0',
    'verProc' => 'NFeMail 3.2.0'
];

$gerarXml->emit = (object) [
    'CNPJ' => 'CNPJ EMITENTE',
    'xNome' => 'RAZAO SOCIAL EMITENTE',
    'xFant' => 'NOME FANTASIA EMITENTE',
    'IE' => 'INSCRICAO ESTADUAL EMITENTE',
    'CRT' => '1',
    'enderEmit' => (object) [
        'xLgr' => 'LOGRADOURO EMITENTE',
        'nro' => 'NUMERO',
        'xCpl' => 'COMPLEMENTO',
        'xBairro' => 'BAIRRO',
        'cMun' => 'CODIGO CIDADE',
        'xMun' => 'NOME CIDADE',
        'UF' => 'ESTADO',
        'CEP' => 'CEP',
        'cPais' => '1058',
        'xPais' => 'BRASIL',
        'fone' => '35760186',
    ],
];

// $gerarXml->dest = [];
$gerarXml->dest = (object) [
    'CNPJ' => 'CNPJ DESTINATARIO',
    'xNome' => 'DESTINATARIO',
    'enderDest' => (object) [
        'xLgr' => 'LOGRADOURO DESTINATARIO',
        'nro' => 'NUMERO',
        'xCpl' => 'COMPLEMENTO',
        'xBairro' => 'BAIRRO',
        'cMun' => 'CODIGO CIDADE',
        'xMun' => 'NOME CIDADE',
        'UF' => 'ESTADO',
        'CEP' => 'CEP',
        'cPais' => '1058',
        'xPais' => 'BRASIL',
    ],
    'indIEDest' => '2',
];

// $gerarXml->det = [];
$det_products = [];
// product 1

$det_products[] = (object) [
    'prod' => (object) [
        'cProd' => 'CODIGO DO PRODUTO 1',
        'cEAN' => '',
        'xProd' => 'DESCRICAO DO PRODUTO 1',
        'NCM' => 'NCM PRODUTO',
        'CFOP' => '5102',
        'uCom' => 'UN',
        'qCom' => '1',
        'vUnCom' => '1.00',
        'vProd' => '1.00',
        'cEANTrib' => '',
        'uTrib' => 'UN',
        'qTrib' => '1',
        'vUnTrib' => '1.00',
        'indTot' => '1',
    ],
    'imposto' => (object) [
        'vTotTrib' => '',
        'ICMS' => (object) [
            'ICMSSN102' => (object) [
                'orig' => '0',
                'CSOSN' => '102',
            ]
        ],
        'PIS' => (object) [
            'PISNT' => (object) [
                'CST' => '07',
            ]
        ],
        'COFINS' => (object) [
            'COFINSNT' => (object) [
                'CST' => '07',
            ]
        ],
    ]
];

$gerarXml->det = $det_products;

$gerarXml->total = (object) [
    'ICMSTot' => (object) [
        'vBC' => '0.00',
        'vICMS' => '0.00',
        'vICMS' => '0.00',
        'vICMSDeson' => '0.00',
        'vBCST' => '0.00',
        'vST' => '0.00',
        'vProd' => '1.00',
        'vFrete' => '0.00',
        'vSeg' => '0.00',
        'vDesc' => '0.00',
        'vII' => '0.00',
        'vIPI' => '0.00',
        'vPIS' => '0.00',
        'vCOFINS' => '0.00',
        'vOutro' => '0.00',
        'vNF' => '1.00',
        'vTotTrib' => '0.28',
    ]
];

$gerarXml->transp = (object) [
    'modFrete' => 9
];

$string_xml = implode($gerarXml->nl, $gerarXml->gerarXml());

print_r($nfemail->enviarArquivoXml($string_xml));
