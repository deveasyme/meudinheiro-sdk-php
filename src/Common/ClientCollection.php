<?php

namespace Meudinheiro\Common;

/**
 * Description of ClientCollection
 *
 * @author Binow
 */
class ClientCollection extends \ArrayIterator{
    
    private $templateClass;
    private $list = array();
    
    function __construct($templateClass, $dataArray = array()) {
        
        $this->templateClass = $templateClass;
        
        $templateClass = $this->templateClass;
        /*Loading object list*/
        $this->list = array_map(function($dataArray) use ($templateClass){
            return $templateClass::fromArray($dataArray);
        },$dataArray);
        
        parent::__construct($this->list);
    }
    
    public function __toString() {
        return print_r($this->list,true);
    }
}
