<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$data_morte = $_POST['data_morte'];
$causa_morte = $_POST['causa_morte'];

$nome = $conn->real_escape_string($nome);
$sexo = $conn->real_escape_string($sexo);
$causa_morte = $conn->real_escape_string($causa_morte);

$sql = "INSERT INTO registros (nome, idade, sexo, data_morte, causa_morte)
        VALUES ('$nome', '$idade', '$sexo', '$data_morte', '$causa_morte')";

if ($conn->query($sql) === TRUE) {
    echo "
    <h2>Registo guardado com sucesso!</h2>
    <div>
    <a href='home.php'>Voltar</a>
    </div>
    ";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();

?>



<head>
    <link rel="stylesheet" href="salvar.css">
</head>