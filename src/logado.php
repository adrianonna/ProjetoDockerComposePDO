<?php
require_once 'classes/Egresso.php';
$e = new Egresso;

session_start();
if(!isset($_SESSION['idusuario'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['nomeCompl'])){ //isset($_POST['id']) && 
    $id = addslashes($_POST['id']);
    $nomeCompactado = addslashes($_POST['nomeCompac']);
    $nome = addslashes($_POST['nomeCompl']);
    $email = addslashes($_POST['email']);
    $linkedin = addslashes($_POST['linkedin']);
    $github = addslashes($_POST['github']);
    $curso = addslashes($_POST['curso']);
    $campus = addslashes($_POST['campus']);
    $egresso = true;

    if (!empty($id) && !empty($nomeCompactado) && !empty($nome) && !empty($curso) && !empty($campus)) {
        $e->conectar("provapdo", "mysql", "root", "abc123");
        if ($e->msgErro=="") {
            if($e->cadastrar($id, $nomeCompactado, $nome, $email, $linkedin, $github, $curso, $campus, $egresso)){
                $msg = '<div id="msg-sucesso">Cadastrado com sucesso!</div>';
            }else{
                $msg = '<div class="msg-erro">Matrícula já cadastrada!</div>';
            }
        }else{
            $msg = '<div class="msg-erro"> Erro: '.$u->msgErro.'</div>';
        }
    }else{
        $msg = '<div class="msg-erro">Preencha todos os campos obrigatórios!</div>';
    }
}
?>

<?php
if (isset($_GET['id'])) {
    $idpessoa = addslashes($_GET['id']);
    $e->conectar("provapdo", "mysql", "root", "abc123");
    $e->excluirPessoa($idpessoa);
    header("Location: logado.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Egressos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/estilologado.css">

</head>

<body>
    <section class="container-fluid w-50" id="login">
        <form method="POST">
            <!-- <button type="submit" class="btn btn-primary btnlogout">Logout</button> -->
        </form>
        <h1 class="cadastrar">Cadastrar Egresso</h1>
        <form method="POST">
            <div class="form-group">
                <label for="id">*Matrícula</label>
                <input class="form-control form-control-sm" type="text" name="id" id="id" placeholder="Matrícula"
                    maxlength="11">
            </div>
            <div class="form-group">
                <label for="nomeCompac">*Nome compactado</label>
                <input class="form-control form-control-sm" type="text" name="nomeCompac" id="nomeCompac" placeholder="Nome compactado"
                    maxlength="30">
            </div>
            <div class="form-group">
                <label for="nomeCompl">*Nome completo</label>
                <input class="form-control form-control-sm" type="text" name="nomeCompl" id="nomeCompl" placeholder="Nome completo"
                    maxlength="60">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-sm" name="email" id="email"
                    aria-describedby="emailHelp" placeholder="Email" maxlength="50">
            </div>
            <div class="form-group">
                <label for="linkedin">LinkedIn</label>
                <input class="form-control form-control-sm" type="text" name="linkedin" id="linkedin" placeholder="LinkedIn"
                    maxlength="90">
            </div>
            <div class="form-group">
                <label for="github">GitHub</label>
                <input class="form-control form-control-sm" type="text" name="github" id="github" placeholder="GitHub"
                    maxlength="90">
            </div>
            <div class="form-group">
                <label for="curso">*Curso</label>
                <input class="form-control form-control-sm" type="text" name="curso" id="curso" placeholder="Curso" maxlength="25">
            </div>
            <div class="form-group">
                <label for="campus">*Campus</label>
                <input class="form-control form-control-sm" type="text" name="campus" id="campus" placeholder="Campus"
                    maxlength="20">
            </div>
            <div class="buttons">
                <input type="submit" value="Cadastrar" class="btn btn-primary">
                <!-- <button type="submit" class="btn btn-primary">Listar</button> -->
            </div>
        </form>
        <?php print($msg) ?>
    </section>
    <section class="bot" id="listar">
    <table id="tabteste">
        <thead>
            <tr id="titulo">
                <td>Matrícula</td>
                <td>Nome compactado</td>
                <td>Nome completo</td>
                <td>Email</td>
                <td>LinkedIn</td>
                <td>GitHub</td>
                <td>Curso</td>
                <td calspan="2">Campus</td>
            </tr>
        </thead>
        <tbody>
    <?php 
        $e->conectar("provapdo", "mysql", "root", "abc123");
        $dados = $e->listarEgressos();
        if(count($dados) > 0){
            for ($i=0; $i < count($dados); $i++) {
                echo '<tr class="values">';
                foreach ($dados[$i] as $k => $v) {
                    if ($k != "egresso") {
                        echo '<td>'.$v.'</td>';
                    }
                }
    ?>
                <td class="buttonstable">
                    <a href="" class="btn btn-primary btn-sm">Editar</a>
                    <a href="logado.php?id=<?php echo $dados[$i]['id'];?>" class="btn btn-primary btn-sm">Excluir</a>
                </td>
    <?php
                echo '</tr>';
            }

        } else{
            "Não existem pessoas cadastradas!";
        }
    ?>
        </tbody>
    </table>
    </section>
</body>
</html>


