<?php

namespace Meudinheiro\Common;


class Client implements ClientInterface{

    /*The client instance*/
    private static $clients = array();
    
    private $clientName;
    
    private $config;
    
    private $templateName;
    
    private static $MEUDINHEIRO_URL = "https://www.meudinheiroweb.com.br/api";
    
    private $request;
    
    public function __construct($clientName, $config) {
        
        $this->clientName = $clientName;
        $this->config = $config;
        
        $base_url = $config['api_url'] ? $config['api_url'] : self::$MEUDINHEIRO_URL;
        
        $this->request = new Request( $base_url.'/'.$clientName, $config );
        
    }
    
    public static function factory($clientName, $config){
        if(!array_key_exists($clientName, self::$clients)){
            self::$clients[$clientName] = new Client($clientName, $config);
        }

        return self::$clients[$clientName];
        
    }
    
    public function setTemplate($templateName){
        $this->templateName = $templateName;
    }
    
    private function _getTemplate(){
        
        $templateName = 'Meudinheiro\\';
        
        if($this->templateName){
            $templateName .= $this->templateName;
        }else{
            $templateName .= ucfirst(substr($this->clientName,0,-1));
        }
        
        if(class_exists($templateName)){
            
            $interfaces = class_implements($templateName);
            if(isset($interfaces['Meudinheiro\Common\TemplateInterface'])){
                return $templateName;
            }
        }
        
        throw new \Meudinheiro\Exception\TemplateNotFoundException($templateName);

    }

    public function get($id = null) {
        return $this->query(array(),$id);
    }

    public function query( array $queryParams = array() , $id = null ){
        
        $data = $this->request->query($queryParams, $id);
        
        $template_class = $this->_getTemplate();
        
        /*Loading one object*/
        if($id !== null){
            return $template_class::fromArray($data);
        }
        
        return new ClientCollection($template_class, $data);
        
        
    }
    
    public function create(TemplateInterface &$template) {
        
        $newTemplateArray = $this->request->post($template->toArray());
        
//        $template->setFr
        
        $template = $template::fromArray($newTemplateArray);
        
//        $template->setId($newTemplate->id);
        
//        return $newTemplate;
        
    }

    public function update(TemplateInterface &$template) {
        
        $newTemplateArray = $this->request->put($template->getId() , $template->toArray());
        
        $template = $template::fromArray($newTemplateArray);
        
    }
    
    public function delete($id) {
        
        $this->request->delete($id);
        
    }
}
