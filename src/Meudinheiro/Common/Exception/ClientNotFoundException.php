<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Meudinheiro\Common\Exception;

/**
 * Description of ClientNotFoundException
 *
 * @author Binow
 */
class ClientNotFoundException extends \Exception{
    
    public function __construct($message, $code, $previous) {
        
        $message = "Classe não encontrada: $message";
        
        parent::__construct($message, $code, $previous);
        
    }
    
}
