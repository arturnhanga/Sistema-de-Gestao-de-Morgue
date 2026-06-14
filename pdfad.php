<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Segurança: só usuários logados
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$tipo = $_SESSION['tipo'];
$id_usuario = $_SESSION['id'];

// Definir tabela e filtro
if ($tipo == "superadmin") {
    $sql = "SELECT * FROM registros_ad ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM registros WHERE id_usuario = $id_usuario ORDER BY id DESC";
}

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
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #e6f2ff; /* azul claro suave */
        color: #000000;
    }

    .box {
        border: 1px solid #4da6ff;
        background-color: #ffffff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 6px;
    }

    h2 {
        text-align: center;
        color: #000000;
        margin-bottom: 20px;
    }

    .print-btn {
        background-color: #4da6ff;
        color: #ffffff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-bottom: 20px;
        font-weight: bold;
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

        .box {
            border-color: #000000;
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

<a href="<?php echo ($tipo == 'superadmin') ? 'superadmin.php' : 'listar.php'; ?>">Voltar</a>
</body>
</html>