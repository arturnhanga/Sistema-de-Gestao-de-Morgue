<html>
    <center><a href="geriradmins.php">Gerir utilizadores</a></center>

<?php
session_start();

// segurança: só superadmin entra
if (!isset($_SESSION['user']) || $_SESSION['tipo'] != "superadmin") {
    header("Location: login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2ff; /* azul claro suave */
        margin: 0;
        padding: 30px;
        color: #000000;
    }

    h1 {
        text-align: center;
        color: #000000;
        margin-bottom: 10px;
        font-size: 2.5rem;
    }

    p {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    hr {
        border: none;
        border-top: 2px solid #4da6ff;
        margin: 20px 0;
    }

    .form {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    fieldset {
        width: 420px;
        padding: 25px;
        border: 2px solid #4da6ff;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    legend {
        font-size: 1.2rem;
        font-weight: bold;
        color: #4da6ff;
        text-align: center;
        padding: 0 10px;
    }

    input,
    textarea {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
        font-size: 1rem;
    }

    input:focus,
    textarea:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 5px rgba(77,166,255,0.5);
    }

    textarea {
        resize: none;
        height: 80px;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #4da6ff;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    button:hover {
        background-color: #3399ff;
        transform: translateY(-2px);
    }

    .links {
        text-align: center;
        margin-top: 20px;
    }

    .links a {
        display: inline-block;
        margin: 10px;
        padding: 10px 15px;
        background-color: #ffffff;
        border: 1px solid #4da6ff;
        color: #000000;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s;
    }

    .links a:hover {
        background-color: #4da6ff;
        color: #ffffff;
    }

    @media (max-width: 500px) {
        fieldset {
            width: 95%;
        }

        h1 {
            font-size: 1.8rem;
        }
    }
</style>

<h1>Painel SuperAdmin</h1>

<p>Bem-vindo, <?php echo $_SESSION['user']; ?>!</p>

<hr>

<div class="form">
<fieldset>
    <legend>Cadastrar Corpo (SuperAdmin)</legend><br>
<form method="POST" action="salvarad.php">
    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="number" name="idade" placeholder="Idade" required><br><br>
    <input type="text" name="sexo" placeholder="Sexo" required><br><br>
    <input type="date" name="data_morte" required><br><br>
    <textarea name="causa_morte" placeholder="Causa da morte" required></textarea><br><br>
    <button type="submit">Salvar</button>
</form>

</fieldset>
</div>
<br>

<hr><br>

<!-- LINKS -->
<div class="links">

    <a href="listarad.php">Meus Registos (SuperAdmin)</a>



    <a href="login.php">Sair</a>

</div>

<div>
    <?php
$conn = new mysqli("localhost", "root", "", "morgue");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// ================== AGENDAMENTOS DE CORPO ==================
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

// ================== AGENDAMENTOS DE CAIXÃO ==================
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
</html>
