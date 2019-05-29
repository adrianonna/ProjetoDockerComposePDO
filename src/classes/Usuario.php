<?php

Class Usuario{
    private $pdo;
    public $msgErro="";

    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host.";port:3306", $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = "Erro de banco de dados: ".$e->getMessage();
            echo $msgError;
        } catch (Exception $e){
            $msgErro = "Erro genérico: ".$e->getMessage();
            echo $msgError;
        }
    }


    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        $sql = $pdo->prepare("SELECT idusuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        }else{
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES(:n, :t, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            //$sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }


    public function logar($email, $senha){
        global $pdo;

        $sql = $pdo->prepare("SELECT idusuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",$senha);
        //$sql->bindValue(":s",md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['idusuario'] = $dado['idusuario'];
            return true;
        }else{
            return false;
        }
    }




}


?>