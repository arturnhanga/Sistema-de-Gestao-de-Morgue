<?php
session_start();

$conn = new mysqli("localhost","root","","morgue");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u = $_POST['username'];
    $s = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE username='$u' AND senha='$s'";
    $res = $conn->query($sql);

    if ($res->num_rows == 1) {
        $_SESSION['user'] = $u;
        header("Location: home.php");
        exit();
    } else {
        echo "Login inválido";
    }
}
?>



<head>
    <link rel="stylesheet" href="index.css">
</head>
<h2>Sistema de Gerenciamento de Morgue</h2><br><br>
<div class="form">
<fieldset>
    <legend>Login</legend>
<form method="POST"><br>
    <input type="text" name="username" placeholder="Username">
    <br><br><input type="password" name="senha" placeholder="Senha"><br>
    <button type="submit">Entrar</button>
</form>
</fieldset>
</div>