<?php


class TemplatesTest extends \PHPUnit_Framework_TestCase{
    
    /**
     *
     * @var Meudinheiro\Common\AbstractClient 
     */
    private $api;
    
    /**
     * @before
     */
    public function setApi(){
        $this->api = Meudinheiro\Common\Meudinheiro::factory(array(
            'api_url' => 'http://apimd.localhost'
        ));
    }
    
    public function testFormas(){
        
        $api = $this->api->get('formas');
        
        $forma = new \Meudinheiro\Forma();
        $forma->nome = "Gustavo";
        
        $api->create($forma);
        
        $this->assertTrue($forma->id > 0);
        
        $forma->nome = "Gustavo Binow";
        $api->update($forma);
        
        
        $formaR = $api->get($forma->id);
        $this->assertEquals($forma->nome,$formaR->nome);
        
        $api->delete($forma->id);
        
        try{
            $api->get($forma->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('FormaNotFound',$ex->getApiError());
        }
        
    }
    

}