<?php

namespace Meudinheiro\Common;


class Request {
    
    private $curl;
    
    private $apiUrl;
    
    public function __construct( $apiUrl , $credentials ) {
        
        // Os dados de autenticacao vao ser configurados aqui no curl
        $this->curl = new \Util\Curl( $apiUrl , $credentials);
        
        $this->apiUrl = $apiUrl;
    }
    
    public function get($id = null){
        return $this->query(array(),$id);
    }
    
    public function query($queryParams = array(), $id = null){
        
        $url = $this->apiUrl;
        if($id !== null) $url .= "/$id";
        $this->curl->get($url,$queryParams);
        
        return $this->curl->getResponseArray();
        
//        return $this->response();
    }
    
    public function post( $data ){
        
        $this->curl->post( $this->apiUrl , $data );
        
        $this->checkResponse();
        
        return $this->curl->getResponseArray()['id'];
    }
    public function put( $id , $data ){
        $this->curl->put( $this->apiUrl ."/$id" , $data );
        
        $this->checkResponse();
    }
    
    public function delete( $id ){
        $this->curl->delete( $this->apiUrl ."/$id" );
        
        $this->checkResponse();
    }
    
    private function checkResponse(){
        
        $status = $this->curl->getResponseStatus();
            
//            echo ($this->curl->getResponseHeaders());
//            echo ($this->curl->getResponseBody());
            
        if($status >= 400){
            
            
            $errorData = $this->curl->getResponseArray();
            
            throw new Exception\ApiRequestException($errorData['erro'],$errorData['msg'],$errorData['dados']);
        }
        
    }
    
}
