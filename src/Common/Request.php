<?php

namespace Meudinheiro\Common;


class Request {
    
    private $client;
    private $apiUrl;
    
    public function __construct( $apiUrl , $credentials ) {
        
        // Os dados de autenticacao vao ser configurados aqui no curl
        $this->client = new \GuzzleHttp\Client();
        
        $this->apiUrl = $apiUrl;
    }
    
    public function get($id = null){
        return $this->query(array(),$id);
    }
    
    public function query($queryParams = array(), $id = null){
        
        return $this->request('GET',$id,[
            'query' => $queryParams
        ]);
    }
    
    public function post( $data ){
        
        return $this->request('POST',null,[
            'form_params' => $data
        ]);
        
    }
    public function put( $id , $data ){
        
        return $this->request('PUT',$id,[
            'json' => $data
        ]);
        
    }
    
    public function delete( $id ){
        
        $this->request('DELETE',$id);
        
    }
    
    private function request($method, $uri = null , array $options = []){
        
        try{
            
            $url = $this->apiUrl;
            
            if($uri) $url .= '/' . $uri;
            
            $response = $this->client->request($method,$url,$options);

//            echo $response->getBody();
            
            return json_decode($response->getBody(),true);
            
        
//            echo $ex->getMessage();
            
        /*Is thrown for 400 level errors if the http_errors request option is set to true*/ 
        } catch (\GuzzleHttp\Exception\ClientException $ex) {
            
            $response = $ex->getResponse();
            
            $error = json_decode($response->getBody());
            
            $exApi = new \Meudinheiro\Exception\ApiRequestException($error->error, $error->message,$ex->getCode());
            
            throw $exApi;
       
        /* Is thrown for 500 level errors if the http_errors request option is set to true*/
        } catch (\GuzzleHttp\Exception\ServerException $ex) {

//            $response = $ex->getResponse();
            
//            echo $response->getBody();
            
//            $error = json_decode($response->getBody());
            
//            $exApi = new \Meudinheiro\Exception\ApiRequestException($error->error, $error->message);
            
//            throw $exApi;
            throw $ex; 
            
        /*In the event of a networking error (connection timeout, DNS errors, etc.)*/
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            throw $ex; 
        }
        
    }
    
}
