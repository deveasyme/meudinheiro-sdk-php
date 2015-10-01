<?php

namespace Meudinheiro\Contas;

use Meudinheiro\Common\TemplateInterface;

class ContaTemplate implements TemplateInterface{
    
    private $id;
    private $nome;
    private $saldoInicial;
    private $dataInicio;
    private $tiposInvestimentos;

    public function toArray(){

        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'saldoInicial' => $this->getSaldoInicial(),
            'dataInicio' => $this->getDataInicio(),
            'tiposInvestimentos' => $this->getTiposInvestimentos()    
        );

    }
    
    public static function fromArray(array $contaArr ){
        
        $conta = new ContaTemplate();
        
        $conta->setId($contaArr['id']);
        $conta->setNome($contaArr['nome']);
        $conta->setSaldoInicial($contaArr['saldoInicial']);
        $conta->setDataInicio($contaArr['dataInicio']);
        $conta->setTiposInvestimentos($contaArr['tiposInvestimentos']);
        
        return $conta;
        
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSaldoInicial() {
        return $this->saldoInicial;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getTiposInvestimentos() {
        return $this->tiposInvestimentos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSaldoInicial($saldoInicial) {
        $this->saldoInicial = $saldoInicial;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setTiposInvestimentos($tiposInvestimentos) {
        $this->tiposInvestimentos = $tiposInvestimentos;
    }
    
}
