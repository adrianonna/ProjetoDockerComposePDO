<?php
session_start();
if(!isset($_SESSION['idusuario'])){
    header("location: index.php");
    exit;
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

</head>

<body>
    <div class="container">
        <table class="table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Curso</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">LinkedIn</th>
                </tr>
            </thead>
            <tbody class="data">
            </tbody>
        </table>
    </div>

    <script>
        let data = document.querySelector(".data");
        fetch('https://raw.githubusercontent.com/ifpb/egressos/master/data/egressos.json')
            .then(response => response.json())
            .then(json => {
                json.forEach(element => {
                    data.insertAdjacentHTML(
                        "beforeend",
                        `<tr>
                            <td>${element.nome}</td>
                            <td>${element.curso}</td>
                            <td>${element.email}</td>
                            <td>${element.linkedin}</td>
                        </tr>`
                    )
                });
            })    
    </script>
</body>

</html>