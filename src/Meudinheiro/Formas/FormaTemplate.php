<?php

namespace Meudinheiro\Formas;

use Meudinheiro\Common\TemplateInterface;

class FormaTemplate implements TemplateInterface{
    
    private $id;
    private $nome;
    

    public function toArray(){

        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome()
        );

    }
    
    public static function fromArray(array $data ){
        
        $forma = new FormaTemplate();
        
        $forma->setId($data['id']);
        $forma->setNome($data['nome']);
        
        return $forma;
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }


}
