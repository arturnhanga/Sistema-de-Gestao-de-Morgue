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
    <link rel="stylesheet" href="gerar_pdf.css">
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
        }

        .print-btn {
            background: blue;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

<button class="print-btn" onclick="window.print()">Imprimir / Guardar PDF</button>

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