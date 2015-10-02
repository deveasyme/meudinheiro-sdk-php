<?php

namespace Meudinheiro\Common;

interface TemplateInterface {
    
    public function getId();
    
    public function setId( $id );
    
    /**
     * 
     * @param array $data 
     * @return TemplateInterface
     */
    public static function fromArray(array $data );
    
    /**
     * @return array
     */
    public function toArray();
    
}
