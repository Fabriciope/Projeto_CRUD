<?php
$pdo=new PDO('mysql:host=localhost;dbname=mylist', 'root', '');
require_once 'controller.php';
if(isset($_GET['idedicao']) ){
    $pessoaEditada= $editarPessoa->exibirDadosParaEdicao($_GET['idedicao']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>MyList</title>
</head>
<body>
    <div id="main">
        <div id="form">
            <form action="<?php 
            if(isset($_GET['idedicao'])){
                echo 'controller.php?atualizar&idup='. $_GET['idedicao'];
            }else{
                echo 'controller.php?cadastrar';
            }
            ?>" method='post'>
                <h2>Cadastrar pessoa</h2>
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php 
                    if(isset($_GET['idedicao'])){
                         echo $pessoaEditada['nome'];
                    }
                    ?>">
                </div>
                <div>
                    <label for="numero">Numero:</label>
                    <input type="text" name="numero" value="<?php 
                    if(isset($_GET['idedicao'])){
                         echo $pessoaEditada['numero'];
                    }
                    ?>">
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" value="<?php 
                    if(isset($_GET['idedicao'])){
                         echo $pessoaEditada['email'];
                    }
                    ?>">
                </div>
                <?php
            if (isset($_GET['mensagem'])){
                switch ($_GET['mensagem']){
                    case 1:
                        echo 'Preencha os campos vazios';
                        break;
                    case 2:
                        echo 'Cadastro realizado';
                        break;
                    case 3:
                        echo 'Cadastro editado com sucesso';
                        break;
                    case 4:
                        echo 'Cadastro excluido com sucesso';
                        break;
                }
            }
            ?>
                <button type="submit"><?php
                   if(isset($_GET['idedicao'])){
                    echo 'Atualizar';
                   }else{
                    echo 'Cadastrar';
                   }
                ?></button>
            </form>
        </div>
        <div >
            <table>
                 <thead>
                   <th>Nome</th>
                   <th>Número</th>
                   <th colspan="2">E-mail</th>
                </thead>
                <tbody>
                    <?php
                    $stmp=$pdo->query("select id_pessoa,nome,numero,email from pessoa order by nome asc");
                    $res=$stmp->fetchAll(PDO::FETCH_OBJ);
                    if(count($res) > 0){
                        foreach($res as  $valor){?>
                            <tr>
                                <td><?= $valor->nome ?></td>
                                <td><?= $valor->numero ?></td>
                                <td><?= $valor->email?></td>
                                <td>
                                <a href="index.php?idedicao= <?php echo $valor->id_pessoa; ?>">Editar</a>
                                <a href="controller.php?idexclusao= <?php echo $valor->id_pessoa; ?>" >Excluir</a>
                                </td>
                            </tr>
                        <?php }
                    }?>
                </tbody>

            </table>
        </div>
    </div>
</body>
</html>