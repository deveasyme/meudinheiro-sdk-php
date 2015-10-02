<?php

namespace Meudinheiro\Common;

/**
 * Description of ClientCollection
 *
 * @author Binow
 */
class ClientCollection implements \Iterator{
    
    private $templateClass;
    private $list = array();
    
    function __construct($templateClass, $dataArray = array()) {
        $this->templateClass = $templateClass;
        $this->setArray($dataArray);
    }

    /**
     * 
     * @param ClientInterface[] $dataArray
     * @return type
     */
    public function setArray($dataArray){
        
        $templateClass = $this->templateClass;
        /*Loading object list*/
        $this->list = array_map(function($dataArray) use ($templateClass){
            return $templateClass::fromArray($dataArray);
        },$dataArray);
    }

    public function current() {
        return current($this->list);
    }

    public function key() {
        return key($this->list);
    }

    public function next() {
        return next($this->list);
    }

    public function rewind() {
        return reset($this->list);   
    }

    public function valid() {
        return $this->current() !== false;
    }

    public function __toString() {
        return print_r($this->list,true);
    }
}
