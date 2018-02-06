<?php
namespace NfeMail\Gerador;

use \Exception;

/**
 * NfeMail\Gerador\Xml
 * Generate Xml to send 'ArquivoXml'
 * @see https://github.com/nfephp-org/sped-common
*/
class Xml
{
    /* Attirbutes to be saved */
    public $attributes;

    /* Default new line to XML */
    public $nl = PHP_EOL;

    /* Construct class */
    public function __construct()
    {
    }

    public function setNl($nl = PHP_EOL)
    {
        $this->nl = $nl;
    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function getSubItem($obj, $name)
    {
        if (!is_object($obj->$name)) {
            // print_r($obj);
            throw new Exception("Param '".$name."' is not Object.", 1);
        }
        
        $xmlStringArray = [];

        $item = (object) $obj->$name;

        foreach ($item as $key => $value) {
            $xmlStringArray[] = sprintf('<%s>%s</%s>', $key, $value, $key);
        }
        
        return $xmlStringArray;
    }

    public function getEmit()
    {
        if (!is_object($this->emit)) {
            throw new Exception("Param 'emit' is not Object.", 1);
        }
        
        $xmlStringArray = [];

        $item = $this->emit;

        foreach ($item as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $xmlStringArray[] = sprintf('<%s>%s</%s>', $key, $value, $key);
            }
        }

        $xmlStringArray[] = '<enderEmit>';
        foreach ($this->getSubItem($item, 'enderEmit') as $item_key => $item_value) {
            $xmlStringArray[] = $item_value;
        }
        $xmlStringArray[] = '</enderEmit>';

        return $xmlStringArray;
    }

    public function getDest()
    {
        if (!is_object($this->dest)) {
            throw new Exception("Param 'dest' is not Object.", 1);
        }
        
        $xmlStringArray = [];

        $item = $this->dest;

        foreach ($item as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $xmlStringArray[] = sprintf('<%s>%s</%s>', $key, $value, $key);
            }
        }

        $xmlStringArray[] = '<enderDest>';

        foreach ($this->getSubItem($item, 'enderDest') as $item_key => $item_value) {
            $xmlStringArray[] = $item_value;
        }
        
        $xmlStringArray[] = '</enderDest>';

        return $xmlStringArray;
    }

    public function getDet()
    {
        if (!is_array($this->det)) {
            throw new Exception("Param 'det' is not Array.", 1);
        }
        
        $xmlStringArray = [];

        $items = $this->det;

        $total_det = count($items);

        if ($total_det < 1) {
            throw new Exception("Dont have products, please add param 'det' (array of products)", 1);
        }

        for ($i=0; $i < $total_det; $i++) {
            
            $item = $items[$i];

            $xmlStringArray[] = sprintf('<det nItem="%s">', $i + 1);

            $xmlStringArray[] = '<prod>';

            foreach ($this->getSubItem($item, 'prod') as $item_key => $item_value) {
                $xmlStringArray[] = $item_value;
            }

            $xmlStringArray[] = '</prod>';

            $xmlStringArray[] = '<imposto>';
            $xmlStringArray[] = sprintf('<vTotTrib>%s</vTotTrib>', $item->imposto->vTotTrib);
            $xmlStringArray[] = '   <ICMS>';
            $xmlStringArray[] = '       <ICMSSN102>';
            $xmlStringArray[] = sprintf('<orig>%s</orig>', $item->imposto->ICMS->ICMSSN102->orig);
            $xmlStringArray[] = sprintf('<CSOSN>%s</CSOSN>', $item->imposto->ICMS->ICMSSN102->CSOSN);
            $xmlStringArray[] = '       </ICMSSN102>';
            $xmlStringArray[] = '   </ICMS>';
            $xmlStringArray[] = '   <PIS>';
            $xmlStringArray[] = '       <PISNT>';
            $xmlStringArray[] = sprintf('<CST>%s</CST>', $item->imposto->PIS->PISNT->CST);
            $xmlStringArray[] = '       </PISNT>';
            $xmlStringArray[] = '   </PIS>';
            $xmlStringArray[] = '   <COFINS>';
            $xmlStringArray[] = '       <COFINSNT>';
            $xmlStringArray[] = sprintf('<CST>%s</CST>', $item->imposto->COFINS->COFINSNT->CST);
            $xmlStringArray[] = '       </COFINSNT>';
            $xmlStringArray[] = '   </COFINS>';
            $xmlStringArray[] = '</imposto>';

            $xmlStringArray[] = '</det>';
        }

        return $xmlStringArray;
    }

    public function gerarXml()
    {
        $xmlString = [];

        // default params
        $xmlString[] = '<?xml version="1.0"?>';
        $xmlString[] = '<NFe xmlns="http://www.portalfiscal.inf.br/nfe">';
        $xmlString[] = sprintf('<infNFe Id="%s" versao="3.10">', $this->Id);

        // identifcation
        $xmlString[] = '<ide>';
        $xmlString = array_merge($xmlString, $this->getSubItem($this, 'ide'));
        // $xmlString[] = implode($this->nl, $this->getSubItem($this, 'ide'));
        $xmlString[] = '</ide>';

        // company, emmiter
        $xmlString[] = '<emit>';
        //$xmlString[] = implode($this->nl, $this->getEmit());
        $xmlString = array_merge($xmlString, $this->getEmit());
        $xmlString[] = '</emit>';

        // customer, destination
        $xmlString[] = '<dest>';
        //$xmlString[] = implode($this->nl, $this->getDest());
        $xmlString = array_merge($xmlString, $this->getDest());
        $xmlString[] = '</dest>';

        // products
        // $xmlString[] = implode($this->nl, $this->getDet());
        $xmlString = array_merge($xmlString, $this->getDet());

        // total + tax
        $xmlString[] = '<total>';
        $xmlString[] = '<ICMSTot>';
        // $xmlString[] = implode($this->nl, $this->getSubItem($this->total, 'ICMSTot'));
        $xmlString = array_merge($xmlString, $this->getSubItem($this->total, 'ICMSTot'));
        $xmlString[] = '</ICMSTot>';
        $xmlString[] = '</total>';

        // shipping
        $xmlString[] = '<transp>';
        $xmlString[] = sprintf('<modFrete>%s</modFrete>', $this->transp->modFrete);
        $xmlString[] = '</transp>';

        // closing tags
        $xmlString[] = '</infNFe>';
        $xmlString[] = '</NFe>';

        return $xmlString;
    }
}
