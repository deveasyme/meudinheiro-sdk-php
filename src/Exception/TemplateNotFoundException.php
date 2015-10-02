<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Meudinheiro\Exception;

/**
 * Description of ClientNotFoundException
 *
 * @author Binow
 */
class TemplateNotFoundException extends \Exception{
    
    public function __construct($message, $code, $previous) {
        
        $message = "Template not found: $message";
        
        parent::__construct($message, $code, $previous);
        
    }
    
}
