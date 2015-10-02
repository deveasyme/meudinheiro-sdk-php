<?php

class FormasTest extends \PHPUnit_Framework_TestCase{
    
    /**
     *
     * @var Meudinheiro\Common\AbstractClient 
     */
    private $api;
    
    /**
     * @before
     */
    public function setApi(){
        $apiMd = Meudinheiro\Common\Meudinheiro::factory(array(
            'api_url' => 'http://apimd.localhost'
        ));
        
        $this->api = $apiMd->get('formas');
    }
    
    
    public function testQueryFormas(){
        
        $forma = new \Meudinheiro\Forma();
        
//        $forma->id  = 2;
        $forma->nome = "Gus22x";
        
        try{
            
            $formas = $this->api->create($forma);
//            
            $this->assertTrue($forma->id != 0);
            
//            $this->api->delete(3);
//            $this->api->update($forma);
            $this->api->create($forma);
            
//            echo $forma->id;
            $resp = $this->api->query();
            
            echo $resp;
            
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {

            echo $ex->getMessage();
            
        }
        
        
        
        
//        var_dump($resp);
        
//        print_r($resp->toArray());
        
        $this->assertTrue(true);
        
    }
    
}