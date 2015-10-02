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
    
    public function testProjeto(){
        
        $api = $this->api->get('projetos');
        
        $projeto = new \Meudinheiro\Projeto();
        $projeto->nome = "projeto teste 1";
        
        $api->create($projeto);
        
        $this->assertTrue($projeto->id > 0);
        $this->assertEquals('#F2F2F2',$projeto->cor);
        
        $projeto->nome = "projeto teste editado";
        $projeto->cor = "#F3F3F3";
        $api->update($projeto);
        
        
        $projetoR = $api->get($projeto->id);
        $this->assertEquals($projetoR->nome,$projeto->nome);
        $this->assertEquals($projetoR->cor,$projeto->cor);
        
        $api->delete($projeto->id);
        
        try{
            $api->get($projeto->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('ProjetoNotFound',$ex->getApiError());
        }
        
    }

}