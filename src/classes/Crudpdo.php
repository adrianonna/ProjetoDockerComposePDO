<?php

//-------------------------------CONEXÃO

try {
    $pdo = new PDO("mysql:dbname=provapdo;host=mysql;port:3306", "root", "abc123");
} catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
} catch (Exception $e){
    echo "Erro genérico: ".$e->getMessage();
}



//--------------------------------INSERIR
//1º
//prepare: passa algum parâmetro e depois pode substituir(no caso com bindValue)
$sql = $pdo->prepare("INSERT INTO egressos(id, nomeCompactado, nome, email, linkedin, github, curso, campus, egresso)
VALUES(:id, :nc, :n, :em, :l, :g, :cu, :ca, :eg)");

//bindValue pode receber uma variável ou uma string como parâmetro
$sql->bindValue(":id",$id);
$sql->bindValue(":nc",$nomeCompactado);
$sql->bindValue(":n",$nome);
$sql->bindValue(":em",$email);
$sql->bindValue(":l",$linkedin);
$sql->bindValue(":g",$github);
$sql->bindValue(":cu",$curso);
$sql->bindValue(":ca",$campus);
$sql->bindValue(":eg",$egresso, PDO::PARAM_BOOL);
$sql->execute();

//2º
//passa o comando por parâmetro e já executa diretamente, os valores em aspas simples
$pdo->query("INSERT INTO egressos(id, nomeCompactado, nome, email, linkedin, github, curso, campus, egresso)
VALUES('1234', 'Adriano', 'Adriano Amaral', 'adriano@gmail', 'wwww', 'github/adrianonna', 'TSI', 'JPA', 'true')");



//----------------------------DELETAR - ATUALIZAR
//DELETAR - pode ser usado com prepare ou query(igual INSERIR)
$sql = $pdo->prepare("DELETE FROM egressos WHERE id = :id");
$sql->bindValue(":id",$id);
$sql->execute();

//ATUALIZAR - pode ser usado com prepare ou query(igual INSERIR)
$sql = $pdo->prepare("UPDATE egressos SET nomeCompactado = :em WHERE id = :id");
$sql->bindValue(":nc","Adriano Amaral");
$sql->bindValue(":id",$id);
$sql->execute();



//----------------------------------SELECT
$sql = $pdo->prepare("SELECT * FROM egressos WHERE id = :id");
$sql->bindValue(":id",$id);
$sql->execute();
$resultado = $sql->fetch(PDO::FETCH_ASSOC); //quando retorna apenas um registro do banco - retorna um array de um elemento, onde existem duas chaves para o mesmo valor, sendo as chaves coluna e index. PDO::FETCH_ASSOC faz retornar apenas as colunas do banco como chaves.
$resultado2 = $sql->fetchAll();//quando retorna vários registros do banco
echo "<pre>";//tag html para melhorar a visualização do resultado
print_r($resultado);
echo "</pre>";//fecha a tag de melhorar visualizaçãos

//percorrer o resultado(array de um ou vários elementos) mostrando apenas as chaves e valores de forma agradável para o usuário
foreach ($resultado as $key => $value) {
    echo $key.": ".$value."<br>";
}



?>