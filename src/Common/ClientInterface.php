<?php

namespace Meudinheiro\Common;

interface ClientInterface {
    
    public function get( $id = null );
    
    public function query( array $queryParams = array() , $id = null );
    
    public function create( TemplateInterface $template );
    
    public function update( TemplateInterface $template );
    
    public function delete( $id );
    
}
