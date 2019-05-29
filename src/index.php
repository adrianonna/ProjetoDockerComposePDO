<?php
require_once 'classes/Usuario.php';
$u = new Usuario;

if(isset($_POST['email'])){
  $email = addslashes($_POST['email']);
  $senha = addslashes($_POST['senha']);

  if ( !empty($email) && !empty($senha)) {
      $u->conectar("provapdo", "mysql", "root", "abc123");
      if($u->msgErro == ""){
          if($u->logar($email, $senha)){
              header("Location: logado.php");
          }else{
            $msg =  '<div class="msg-erro">Email ou senha estão incorretos!</div>';
          }
      }else{
        $msg = '<div class="msg-erro"> Erro: '.$u->msgErro.'</div>';
      }
  }else{
    $msg = '<div class="msg-erro">Preencha todos os campos!</div>';   
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
  <link rel="stylesheet" href="CSS/estiloindex.css">
</head>

<body>
  <div class="container-fluid w-50" id="login">
    <h1 class="logar">Login</h1>
    <form method="POST"> <!-- action="process.php" se for usar em outro arquivo -->
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Enter email" maxlenght="40">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Enter password" maxlenght="15">
      </div>
      <div class="buttons-login">
        <button type="submit" class="btn btn-primary">Entrar</button>
        <h6>Ainda não é cadastrado? <a href="cadastrar.php"><strong> Cadastre-se!</strong></a></h6>
      </div>
    </form>
    <?php print($msg) ?>
  </div>


</body>
</html>