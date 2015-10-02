<?php

namespace Meudinheiro\Exception;

/**
 * Description of ClientNotFoundException
 *
 * @author Binow
 */
class ApiRequestException extends \Exception{
    
    private $apiErrorId;
    
    public function __construct($apiErrorId, $message, $httpCode) {
        
        parent::__construct($message, $httpCode, null);
     
        
        $this->apiErrorId = $apiErrorId;
    }
    
    public function getApiError(){
        return $this->apiErrorId;
    }
}
