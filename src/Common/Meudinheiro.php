<?php


namespace Meudinheiro\Common;

class Meudinheiro {
    
    private static $credentials;
    
    private static $factory;
    
    /**
     * 
     * @param type $credentials
     */
    public static function factory($credentials){
        
        if(!self::$factory)
            self::$factory = new Factory($credentials);
        
        return self::$factory;
        
    }
    
    
}
