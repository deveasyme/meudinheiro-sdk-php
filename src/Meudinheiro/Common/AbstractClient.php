<?php

namespace Meudinheiro\Common;


abstract class AbstractClient implements ClientInterface{

    /*The client instance*/
    private static $singleton;
    
    private $config;
    
    private static $MEUDINHEIRO_URL = "https://www.meudinheiroweb.com.br/api";
    
    private $request;
    
    public function __construct($config) {
        
        $this->config = $config;
        
        $apiName = strtolower(str_replace("Client","",end(explode('\\', get_called_class()))));
        
        $base_url = $config['api_url'] ? $config['api_url'] : self::$MEUDINHEIRO_URL;
        
        $this->request = new Request( $base_url.'/'.$apiName, $config );
        
        
    }
    
    public static function factory($config){
        
        if(!self::$singleton){
            /*Parent class name*/
            $calledClass = get_called_class();
            self::$singleton = new $calledClass($config);
        }

        return self::$singleton;
        
    }
    
    private function _getTemplate(){
        $called_class_array = explode('\\', get_called_class());
        $template_class_name = str_replace("sClient","",end($called_class_array)) . 'Template';
        $called_class_array[sizeof($called_class_array) - 1] = $template_class_name;
        $template_class_name = implode("\\", $called_class_array);

        if(class_exists($template_class_name)){
            $interfaces = class_implements($template_class_name);
            if(isset($interfaces['Meudinheiro\Common\TemplateInterface'])){
                return $template_class_name;
            }
        }

        throw new Exception\TemplateNotFoundException($template_class_name);
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
        
        /*Loading object list*/
        return array_map(function($dataArray) use ($template_class){
            return $template_class::fromArray($dataArray);
        },$data);
        
    }
    
    public function create(TemplateInterface $template) {
        
        $id = $this->request->post($template->toArray());
        
        $template->setId($id);
        
    }

    public function update(TemplateInterface $template) {
        
        $id = $this->request->put($template->getId() , $template->toArray());
        
        $template->setId($id);
        
    }
    
    public function delete($id) {
        
        $this->request->delete($id);
        
    }
}
