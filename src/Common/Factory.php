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
        
        return Client::factory($clientName,$this->config);
        
    }
    
    
}
