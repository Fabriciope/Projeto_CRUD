<?php
require_once 'controller.php';
class EditarPessoa{
    private $pdo;
    private $pessoa;
    
    public function __construct($localhost, $pessoa){
        try{
         $this->pdo= new PDO($localhost,'root','');
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->pessoa=$pessoa;
    }
    public function inserir(){
        $stmp=$this->pdo->prepare("insert into pessoa(nome, numero, email) values (:nome, :numero, :email)");
        $stmp->bindValue(":nome", $this->pessoa->__get('nome'));
        $stmp->bindValue(":numero", $this->pessoa->__get('numero'));
        $stmp->bindValue(":email", $this->pessoa->__get('email'));
        $stmp->execute();
    }
    public function deletar($id_deletado){
        $stmp=$this->pdo->prepare("delete from pessoa where id_pessoa = :id");
        $stmp->bindValue(':id',$id_deletado);
        $stmp->execute();
    }
    public function exibirDadosParaEdicao($id_edicao){
        $retorno_array_id_edicao=array();
        $stmp=$this->pdo->prepare("select * from pessoa where id_pessoa = :id");
        $stmp->bindValue(':id',$id_edicao);
        $stmp->execute();
        $retorno_array_id_edicao=$stmp->fetch(PDO::FETCH_ASSOC);
        return $retorno_array_id_edicao;
    }
    public function editar($idup){
       $stmp=$this->pdo->prepare("update pessoa set nome= :novo_nome, numero= :novo_numero, email= :novo_email where id_pessoa = $idup");
       $stmp->bindValue(':novo_nome', $this->pessoa->__get('nome'));
       $stmp->bindValue(':novo_numero', $this->pessoa->__get('numero'));
       $stmp->bindValue(':novo_email', $this->pessoa->__get('email'));
       $stmp->execute();
    }
}