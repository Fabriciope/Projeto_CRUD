<?php
require_once 'editar_pessoa.php';
require_once 'pessoa.php';

$pessoa= new Pessoa();
$editarPessoa= new EditarPessoa('mysql:host=localhost;dbname=mylist', $pessoa);


 
// --------Cadastrar nova pessoa---------
if(isset($_GET['cadastrar'])){
// --------Verificar se algum campo esta vazio---------
    if($_POST['nome'] == '' || $_POST['numero'] == 0 || $_POST['email'] == ''){
        header('location:index.php?mensagem=1');
    }else{
        $pessoa->__set('nome', $_POST['nome']);
    $pessoa->__set('numero',$_POST['numero']);
    $pessoa->__set('email',$_POST['email']);
    
    $editarPessoa->inserir();
    header('location:index.php?mensagem=2');
    }
   
}

// --------Editar cadastro---------
if(isset($_GET['atualizar'])){
    $pessoa->__set('nome', $_POST['nome']);
    $pessoa->__set('numero',$_POST['numero']);
    $pessoa->__set('email',$_POST['email']);

    $editarPessoa->editar($_GET['idup']);
    header('location:index.php?mensagem=3');
}

// --------Excluir cadastro---------
if(isset($_GET['idexclusao'])){
    $editarPessoa->deletar($_GET['idexclusao']);
    header('location:index.php?mensagem=4');
}










