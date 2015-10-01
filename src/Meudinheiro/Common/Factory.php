<?php

namespace Meudinheiro\Common;

class Factory {
    
    private $config;
    
    /**
     * 
     * @param array $config 
     * {
     *      key     :  String (User authentication token),
     *      secret  :  String (??)
     *      [api_url] :  String (URL to Meudinheiro API)
     * }
     */
    public function __construct($config) {
        
        $this->config = $config;
        
    }
    
    /**
     * Tenta retornar um cliente pelo nome
     * @param type $clientName
     */
    public function get($clientName){
        
        $clientNameUpper = ucfirst($clientName);
        $className = "Meudinheiro\\{$clientNameUpper}\\{$clientNameUpper}Client";
        
        if(class_exists($className)){
            return $className::factory($this->config);
        }
        
        throw new Exception\ClientNotFoundException($className);
        
    }
    
    
}
