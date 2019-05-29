<?php

Class Egresso{
    private $pdo;
    public $msgErro="";

    public function conectar($nomedb, $host, $usuario, $senha){
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nomedb.";host=".$host.";port:3306", $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = "Erro de banco de dados: ".$e->getMessage();
            echo $msgError;
        } catch (Exception $e){
            $msgErro = "Erro genérico: ".$e->getMessage();
            echo $msgError;
        }
    }


    public function cadastrar($id, $nomeCompactado, $nome, $email, $linkedin, $github, $curso, $campus, $egresso){
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM egressos WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        }else{
            $sql = $pdo->prepare("INSERT INTO egressos(id, nomeCompactado, nome, email, linkedin, github, curso, campus, egresso)
                                VALUES(:id, :nc, :n, :em, :l, :g, :cu, :ca, :eg)");
            $sql->bindValue(":id",$id);
            $sql->bindValue(":nc",$nomeCompactado);
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":em",$email);
            $sql->bindValue(":l",$linkedin);
            $sql->bindValue(":g",$github);
            $sql->bindValue(":cu",$curso);
            $sql->bindValue(":ca",$campus);
            $sql->bindValue(":eg",$egresso);
            //$sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function listarEgressos(){
        global $pdo;

        $arr = array();
        $sql = $pdo->query("SELECT * FROM egressos ORDER BY nome");
        $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }

    public function excluirPessoa($id){
        global $pdo;

        $sql = $pdo->prepare("DELETE FROM egressos WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}
?>