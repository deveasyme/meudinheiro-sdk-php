<?php

namespace Meudinheiro;

use 
Meudinheiro\Common\Template;

class Conta extends Template{
    
    const CONTA_CORRENTE = 1;
    const DINHEIRO = 2;
    const OUTROS = 3;
    const INVESTIMENTO = 4;
    
    public $nome;
    public $tipo;
    public $limite;
    public $compoeSaldo;
    public $status;
    public $saldoExtrato;
    public $dataExtrato;    
    public $apenasTransferencia;
    public $exibirVisaoGeral;    
    public $exibirCelular;    
    public $banco;    
    public $agencia;
    public $numeroConta;    
    public $contato;    
    public $telefone;
    public $tipoInvestimento;
    public $saldoInicial;
    public $dataSaldoInicial;
    public $categorias;
}
