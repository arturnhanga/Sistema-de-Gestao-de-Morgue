<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "morgue";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_POST['apagar_tudo'])) {

    $sql_delete = "DELETE FROM registros";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<p style='color:green;'>Todos os registos foram apagados com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro ao apagar: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM registros ORDER BY id DESC";
$result = $conn->query($sql);

echo "<h2>Lista de Registos</h2>";

echo "
<form method='POST'>
    <button type='submit' name='apagar_tudo' onclick=\"return confirm('Tens a certeza que queres apagar TODOS os registos?')\" style='background:red;color:white;padding:10px;border:none;cursor:pointer;'>
        Apagar Tudo
    </button>
</form>

<a href='gerar_pdf.php' target='_blank'>
    <button type='button' style='background:blue;color:white;padding:10px;border:none;cursor:pointer;margin-top:10px;'>
        Gerar PDF'S 
    </button>
</a>

<br>
";

echo "<ul>";

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<li>
                <strong>Nome:</strong> {$row['nome']} <br>
                <strong>Idade:</strong> {$row['idade']} anos <br>
                <strong>Sexo:</strong> {$row['sexo']} <br>
                <strong>Data da morte:</strong> {$row['data_morte']} <br>
                <strong>Causa:</strong> {$row['causa_morte']}
              </li><br>";
    }

} else {
    echo "<li>Nenhum registo encontrado</li>";
}

echo "</ul>";

$conn->close();

?>



<head>
    <link rel="stylesheet" href="listar.css">
</head>
<a href="home.php">Voltar</a>