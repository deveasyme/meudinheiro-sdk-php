<?php

namespace Meudinheiro\Exception;

/**
 * Description of ClientNotFoundException
 *
 * @author Binow
 */
class ApiRequestException extends \Exception{
    
    public function __construct($code, $message) {
        
        parent::__construct($message, $code, null);
        
    }
    
    
}
