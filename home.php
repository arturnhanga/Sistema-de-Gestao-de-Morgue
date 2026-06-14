<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$tipo = $_SESSION['tipo'];
?>

<head>
    <meta charset="UTF-8">
</head>

<p class="p">Bem-vindo ao Painel Principal, <?php echo $_SESSION['user']; ?>!</p>

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

<hr>
<div class="links">
<a href="listar.php">Registos</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="login.php">Sair</a>
</div>

<div>
   <?php
$conn = new mysqli("localhost", "root", "", "morgue");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$result_corpo = $conn->query("SELECT * FROM agendamento_corpo ORDER BY id DESC");

echo "<h2>Agendamentos de Corpo</h2>";

if ($result_corpo->num_rows > 0) {
    while ($row = $result_corpo->fetch_assoc()) {
        echo "<div style='border:1px solid #000; padding:10px; margin:10px;'>";
        echo "<strong>Nome:</strong> " . $row['nome_falecido'] . "<br>";
        echo "<strong>Local:</strong> " . $row['local'] . "<br>";
        echo "<strong>Data/Hora:</strong> " . $row['data_hora'] . "<br>";
        echo "<strong>Status:</strong> " . $row['status'] . "<br>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum agendamento de corpo encontrado.</p>";
}

$result_caixao = $conn->query("SELECT * FROM agendamento_caixao ORDER BY id DESC");

echo "<h2>Agendamentos de Caixão</h2>";

if ($result_caixao->num_rows > 0) {
    while ($row = $result_caixao->fetch_assoc()) {
        echo "<div style='border:1px solid #000; padding:10px; margin:10px;'>";
        echo "<strong>Tipo de Caixão:</strong> " . $row['tipo_caixao'] . "<br>";
        echo "<strong>Descrição:</strong> " . $row['descricao'] . "<br>";
        echo "<strong>Status:</strong> " . $row['status'] . "<br>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum agendamento de caixão encontrado.</p>";
}

$conn->close();
?> 
</div>

<style>
    
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2ff;
        margin: 0;
        padding: 45px;
        color: #000000;
    }

    .links {
        text-align: center;
        margin-bottom: 20px;
        color: #816f6f;
    }

    .p {
        font-size: 40px;
        text-align: center;
        margin-bottom: 20px;
        color: #968383;
    }
    
    p{
        text-align: center;
        margin-bottom: 20px;
    }

    .form {
        position: relative;
        max-width: 400px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    fieldset {
        text-align: center;
        width: 89%;
        border-radius: 8px;
        border: 2px solid #4da6ff;
        padding: 20px;
        margin-bottom: 20px;
    }

    legend {
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: #4da6ff;
    }

    input[type="text"], input[type="password"], input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 5px rgba(77, 166, 255, 0.5);
    }

    button {
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        margin: 5px;
        border-radius: 6px;
        background-color: #4da6ff;
        color: #ffffff;
        font-weight: bold;
        transition: 0.3s;
    }

    button:hover {
        background-color: #3399ff;
    }

    /* Responsividade */
    @media (max-width: 480px) {
        body {
            padding: 20px;
        }

        .form {
            padding: 20px;
        }

        h1 {
            font-size: 36px;
        }
    }
</style>