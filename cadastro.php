<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];
    $morada   = $_POST['morada'];
    $senha    = $_POST['senha'];

    // segurança básica
    $username = $conn->real_escape_string($username);
    $nome     = $conn->real_escape_string($nome);
    $email    = $conn->real_escape_string($email);
    $telefone = $conn->real_escape_string($telefone);
    $morada   = $conn->real_escape_string($morada);
    $senha    = $conn->real_escape_string($senha);

    // TODOS SÃO "usuario"
    $tipo = "usuario";

    $stmt = $conn->prepare("INSERT INTO usuarios 
        (username, nome, email, telefone, morada, senha, tipo)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssss",
        $username,
        $nome,
        $email,
        $telefone,
        $morada,
        $senha,
        $tipo
    );

    if ($stmt->execute()) {

        header("Location: usuario.php");
        exit();

    } else {
        echo "<p style='color:red;'>Erro: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #e6f2ff;
        color: #000000;
    }

    .container {
        width: 350px;
        margin: 35px auto;
        background: #ffffff;
        padding: 28px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-top: 5px solid #4da6ff;
    }

    input {
        width: 327px;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 5px rgba(77, 166, 255, 0.5);
    }

    button {
        width: 100%;
        padding: 12px;
        background: #4da6ff;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    button:hover {
        background: #3399ff;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Cadastro do SGM</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="text" name="morada" placeholder="Morada" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Registar</button>
        <a href="login.php">entrar</a><br>
        <a href="index.php">voltar</a>
    </form>
</div>

</body>
</html>