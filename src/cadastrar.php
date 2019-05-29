<?php
require_once 'classes/Usuario.php';
$u = new Usuario;

if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);


    if ( !empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
        //$u->conectar("provapdo", "mysql", "root", "abc123");
        if ($u->conectar("provapdo", "mysql", "root", "abc123")) {
            if ($senha==$confirmarSenha) {
                if($u->cadastrar($nome, $telefone, $email, $senha)) {
                    $msg =  '<div id="msg-sucesso">Cadastrado com sucesso!</div>';
                }else {
                    $msg =  '<div class="msg-erro">Email já cadastrado!</div>';
                }
            }else {
                $msg =  '<div class="msg-erro">Senha e confirmar senha não correspondem!</div>';
            }
        }else {
            $msg = '<div class="msg-erro"> Erro: '.$u->msgErro.'</div>';
         }
    }else {
        $msg =  '<div class="msg-erro">Preencha todos os campos!</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjetoPDO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/estilocadastrar.css">
</head>

<body>

    <div class="container-fluid w-50" id="login">
    <a href="index.php"><button type="button" class="btn btn-outline-primary float-right">Login</button></a>
        <h1 class="cadastrar">Cadastrar</h1>
        <form method="POST">
            <div class="form-group">
                <label for="formGroupExampleInput">Nome completo</label>
                <input class="form-control" type="text" name="nome" placeholder="Nome completo" maxlength="30">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Telefone</label>
                <input class="form-control" type="text" name="telefone" placeholder="Telefone" maxlength="30">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" maxlength="40">
                <small id="emailHelp" class="form-text text-muted small">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="Enter password" maxlength="15">
                <label for="exampleInputPassword1">Confirmar senha</label>
                <input type="password" class="form-control" name="confSenha" placeholder="Enter password" maxlength="15">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
        <?php print($msg) ?>
    </div>

</body>

</html>