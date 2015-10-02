<?php

namespace Meudinheiro\Common;


abstract class Template implements TemplateInterface{
    
    public $id;
    
    public function __toString() {
        return print_r($this->toArray(),true);
    }
    
    public static function fromArray(array $data) {
        
        $childClassName = get_called_class();
        
        $childClass = new $childClassName();
        
        foreach(get_class_vars($childClassName) as $f=>$v){
            $childClass->$f = $data[$f];
        }
        
        return $childClass;
        
    }

    public function toArray() {
        $ar = array();
        foreach($this as $key => $value){
            $ar[$key] = $value;
        }
        return $ar;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
}
