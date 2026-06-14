<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['tipo'] != "superadmin") {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['id'])) {
    die("Erro: usuário não identificado. Faça login novamente.");
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome        = $_POST['nome'] ?? '';
$idade       = $_POST['idade'] ?? '';
$sexo        = $_POST['sexo'] ?? '';
$data_morte  = $_POST['data_morte'] ?? '';
$causa_morte = $_POST['causa_morte'] ?? '';

$id_usuario = $_SESSION['id'];

$nome        = $conn->real_escape_string($nome);
$sexo        = $conn->real_escape_string($sexo);
$causa_morte = $conn->real_escape_string($causa_morte);

$stmt = $conn->prepare("INSERT INTO registros_ad 
    (nome, idade, sexo, data_morte, causa_morte, id_usuario)
    VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Erro na preparação da query: " . $conn->error);
}

$stmt->bind_param(
    "sisssi",
    $nome,
    $idade,
    $sexo,
    $data_morte,
    $causa_morte,
    $id_usuario
);

if ($stmt->execute()) {
    echo "
    <h2>Registo guardado com sucesso!</h2>
    <div>
        <a href='superadmin.php'>Voltar ao Painel SuperAdmin</a>
    </div>
    ";
} else {

    echo "Erro ao salvar registo: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<head>
    <link rel="stylesheet" href="salvar.css">
</head>
<style>
    h2{
        color: #5a3f3f;
    }
</style>