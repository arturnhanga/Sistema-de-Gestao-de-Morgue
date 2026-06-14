<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM registros ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório Morgue</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #e6f2ff;
        color: #000000;
    }

    .box {
        border: 1px solid #4da6ff;
        background-color: #ffffff;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 6px;
    }

    h2 {
        text-align: center;
        color: #000000;
    }

    .print-btn {
        background-color: #4da6ff;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .print-btn:hover {
        background-color: #3399ff;
    }

    @media print {
        .print-btn {
            display: none;
        }
        body {
            background-color: #ffffff;
        }
    }
</style>
</head>

<body>

<center><button class="print-btn" onclick="window.print()">Imprimir / Guardar PDF</button></center>

<h2>RELATÓRIO DE REGISTOS</h2>

<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "
        <div class='box'>
            <strong>Nome:</strong> {$row['nome']} <br>
            <strong>Idade:</strong> {$row['idade']} anos <br>
            <strong>Sexo:</strong> {$row['sexo']} <br>
            <strong>Data da morte:</strong> {$row['data_morte']} <br>
            <strong>Causa:</strong> {$row['causa_morte']}
        </div>
        ";
    }

} else {
    echo "<p>Nenhum registo encontrado</p>";
}

$conn->close();

?>

<a href="listar.php">Voltar</a>
</body>
</html>