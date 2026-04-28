<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="home.css">
</head>
<h1>Painel Principal</h1>

<p>Bem-vindo, <?php echo $_SESSION['user']; ?>!</p>

<hr>

<div class="form">
<fieldset>
    <legend>Cadastrar Corpo</legend><br>
<form method="POST" action="salvar.php">

    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="number" name="idade" placeholder="Idade" required><br><br>
    <input type="text" name="sexo" placeholder="Sexo" required><br><br>
    <input type="date" name="data_morte" required><br><br>
    <textarea name="causa_morte" placeholder="Causa da morte" required></textarea><br>

    <button type="submit">Salvar</button>

</form>
</fieldset>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr>
<div class="links">
<a href="listar.php">Registos</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="login.php">Sair</a>
</div>