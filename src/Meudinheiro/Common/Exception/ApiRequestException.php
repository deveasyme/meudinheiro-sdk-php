<?php

namespace Meudinheiro\Common\Exception;

/**
 * Description of ClientNotFoundException
 *
 * @author Binow
 */
class ApiRequestException extends \Exception{
    
    private $data = array();
    
    public function __construct($code, $message, $data) {
        
        parent::__construct($message, $code, null);
        
        $this->data = $data;
        
    }
    
    public function getData(){
        return $this->data;
    }
    
}
