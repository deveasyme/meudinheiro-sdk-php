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
    
    public function testCentro(){
        
        $api = $this->api->get('centros');
        
        $centro = new \Meudinheiro\Centro();
        $centro->nome = "centro teste 1";
        $centro->tipo = "d";
        
        $api->create($centro);
        
        $this->assertTrue($centro->id > 0);
        
        $centro->nome = "centro teste editado";
        $centro->tipo = "a";
        $api->update($centro);
        
        $centroR = $api->get($centro->id);
        $this->assertEquals($centroR->nome,$centro->nome);
        $this->assertEquals($centroR->tipo,$centro->tipo);
        
        $api->delete($centro->id);
        
        try{
            $api->get($centro->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('CentroNotFound',$ex->getApiError());
        }
        
    }
    
    public function testCategoria(){
        
        $api = $this->api->get('categorias');
        
        // testando categoria sem categoria pai
        $categoria = new \Meudinheiro\Categoria();
        $categoria->nome = 'categoria teste 1';
        $categoria->tipo = 'd';
        $categoria->status = 0;
        
        $api->create($categoria);
        
        $this->assertTrue($categoria->id > 0);
        
        $categoria->nome = "categoria teste editada";
        $categoria->tipo = "r";
        $api->update($categoria);
        
        $categoriaR = $api->get($categoria->id);
        $this->assertEquals($categoriaR->nome,$categoria->nome);
        $this->assertEquals($categoriaR->tipo,$categoria->tipo);
        
        $api->delete($categoria->id);
        
        try{
            $api->get($categoria->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('CategoriaNotFound',$ex->getApiError());
        }
        
        // testando categoria com categoria pai
        $categoria->nome = 'categoria pai teste 2';
        $categoria->tipo = 'r';
        $categoria->status = 1;
        
        $api->create($categoria);
        
        $this->assertTrue($categoria->id > 0);
        
        // criando sub categoria
        $subCategoria = new \Meudinheiro\Categoria();
        $subCategoria->nome = 'sub categoria teste 2';
        $subCategoria->tipo = 'r';
        $subCategoria->status = 1;
        $subCategoria->pai = $categoria->id;
        
        $api->create($subCategoria);
        
        $this->assertTrue($subCategoria->id > 0);
        
        // editando categoria pai
        $categoria->nome = 'categoria pai teste editada 2';
        $api->update($categoria);
        
        // editando subcategoria
        $subCategoria->nome = 'sub categoria teste editada 2';
        $api->update($subCategoria);
        
        // excluindo sub categoria
        $api->delete($subCategoria->id);
        
        // excluindo categoria
        $api->delete($categoria->id);
        
        try{
            $api->get($subCategoria->id);
            $api->get($categoria->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('CategoriaNotFound',$ex->getApiError());
        }
        
        // REALIZAR TESTES PARA VERIFICAR O LANÇAMENTO DE EXCEÇÕES PARA OS CASOS
        
        // [RN02] - Uma categoria filha nao pode ser pai de uma categoria filha
//        $categoriaRn02 = new \Meudinheiro\Categoria();
//        $categoriaRn02->nome = 'categoria pai teste 3';
//        $categoriaRn02->tipo = 'r';
//        $categoriaRn02->status = 1;
//        
//        $api->create($categoriaRn02);
//        
//        $this->assertTrue($categoriaRn02->id > 0);
//        
//        // criando sub categoria
//        $subCategoriaRn02 = new \Meudinheiro\Categoria();
//        $subCategoriaRn02->nome = 'sub categoria 1';
//        $subCategoriaRn02->tipo = 'r';
//        $subCategoriaRn02->status = 1;
//        $subCategoriaRn02->pai = $categoriaRn02->id;
//        
//        $api->create($subCategoriaRn02);
//        
//        // criando sub categoria 2
//        $subCategoriaRn02_2 = new \Meudinheiro\Categoria();
//        $subCategoriaRn02_2->nome = 'sub categoria 2';
//        $subCategoriaRn02_2->tipo = 'r';
//        $subCategoriaRn02_2->status = 1;
//        $subCategoriaRn02_2->pai = $subCategoriaRn02->id;
//        
//        $api->create($subCategoriaRn02_2);
        
        // [RN03] - Uma categoria filha deve ser do mesmo tipo da categoria pai
//        $categoriaRn03 = new \Meudinheiro\Categoria();
//        $categoriaRn03->nome = 'categoria pai teste';
//        $categoriaRn03->tipo = 'r';
//        $categoriaRn03->status = 1;
//        
//        $api->create($categoriaRn03);
//        
//        $this->assertTrue($categoriaRn03->id > 0);
//        
//        // criando sub categoria
//        $subCategoriaRn03 = new \Meudinheiro\Categoria();
//        $subCategoriaRn03->nome = 'sub categoria 1';
//        $subCategoriaRn03->tipo = 'd';
//        $subCategoriaRn03->status = 1;
//        $subCategoriaRn03->pai = $categoriaRn03->id;
//        
//        $api->create($subCategoriaRn03);
        
        // [RN04] - Nao e permitido inserir sub categoria ativa para uma categoria inativa
//        $categoriaRn04 = new \Meudinheiro\Categoria();
//        $categoriaRn04->nome = 'categoria pai teste';
//        $categoriaRn04->tipo = 'r';
//        $categoriaRn04->status = 0;
//        
//        $api->create($categoriaRn04);
//        
//        $this->assertTrue($categoriaRn04->id > 0);
//        
//        // criando sub categoria
//        $subCategoriaRn04 = new \Meudinheiro\Categoria();
//        $subCategoriaRn04->nome = 'sub categoria 1';
//        $subCategoriaRn04->tipo = 'r';
//        $subCategoriaRn04->status = 1;
//        $subCategoriaRn04->pai = $categoriaRn04->id;
//        
//        $api->create($subCategoriaRn04);
        
        // Excluir categoria pai com sub categoria ativa ou inativa
        
    }
    
    public function testConta(){
        
        $api = $this->api->get('contas');
        
        $conta = new \Meudinheiro\Conta();
        $conta->nome = "conta teste 1";
        $conta->tipo = 1;
        $conta->saldoExtrato = 0;
        $conta->banco = '001';
        $conta->agencia = '0213 SP';
        $conta->numeroConta = '12.398-12';
        $conta->limite = 200.0;
        $conta->contato = '';
        $conta->telefone = '';
        $conta->tipoInvestimento = 1;
        
        // campos opcionais
        // $conta->dataExtrato = date('Y/m/d', strtotime('1983-08-25'));
        // $conta->status = 0;
        // $conta->compoeSaldo = 0;
        // $conta->apenasTransferencia = 1;
        // $conta->exibirVisaoGeral = 0;
        // $conta->exibirCelular = 0;
        
        $api->create($conta);
        
        $this->assertTrue($conta->id > 0);
        
        $conta->nome = "conta teste editada";
        $api->update($conta);
        
        $contaR = $api->get($conta->id);
        $this->assertEquals($conta->nome,$contaR->nome);
        
    }
    
    public function testContato(){
        
        $api = $this->api->get('contatos');
        
        $contato = new \Meudinheiro\Contato();
        
        $contato->nome = 'contato teste ccu';
        $contato->tipo_pessoa = 'f';
        $contato->tipo_contato = 'c';
        $contato->dataNascimento = '1983-08-25' ;
        $contato->cpf = '99999999999';
        $contato->rg = '2761830';
        $contato->sexo = 'm';
        $contato->telefone = '2733333333';
        $contato->telefone2 = '2733333333';
        $contato->telefone3 = '2733333333';
        $contato->email = 'fulano@email.com';
        $contato->endereco = 'rua do maluco';
        $contato->complemento = 'apartamento';
        $contato->numero = '279-A';
        $contato->bairro = 'Guaranhuns';
        $contato->cidade = 'Vila Velha';
        $contato->uf = 'ES';
        $contato->cep = '29103245';
        $contato->observacao = 'observacao';
        
        $api->create($contato);
        
        $this->assertTrue($contato->id > 0);
        
        $contato->nome = "contato teste ccu editado";
        
        $api->update($contato);
        
        $contatoR = $api->get($contato->id);
        $this->assertEquals($contato->nome,$contatoR->nome);
        
        // excluindo contato
        $api->delete($contato->id);
        
        try{
            $api->get($contato->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('ContatoNotFound',$ex->getApiError());
        }
        
    }
    
    public function testCategoriaContato(){
        
        $api = $this->api->get('categoriasContatos');
        
        $api->setTemplate('CategoriaContato');
        
        $categoriaContato = new \Meudinheiro\CategoriaContato(); 
        
        $categoriaContato->nome = 'categoria contato teste ccu';
        
        $api->create($categoriaContato);
        
        $this->assertTrue($categoriaContato->id > 0);
        
        $categoriaContato->nome = "categoria contato teste ccu editado";
        
        $api->update($categoriaContato);
        
        $categoriaContatoR = $api->get($categoriaContato->id);
        
        $this->assertEquals($categoriaContato->nome,$categoriaContatoR->nome);
        
    }
    
    public function testRegra(){
        
        $api = $this->api->get('regras');
        
        $regra = new \Meudinheiro\Regra();
        
        $regra->nome = "regra inclusão teste";
        $regra->descricao_importacao = 'descricao importacao';
        $regra->tipo_lancamento = 'd';
        
        $api->create($regra);
        
        $this->assertTrue($regra->id > 0);
        
        $regra->nome = "regra inclusão teste editada";
        $regra->tipo_lancamento = 'r';
        
        $api->update($regra);
        
        $regraR = $api->get($regra->id);
        $this->assertEquals($regra->nome,$regraR->nome);
        
        // excluindo regra
        $api->delete($regra->id);
        
        try{
            $api->get($regra->id);
        } catch (\Meudinheiro\Exception\ApiRequestException $ex) {
            $this->assertEquals('RegraNotFound',$ex->getApiError());
        }
        
    }

}