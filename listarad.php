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

// segurança
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$tipo = $_SESSION['tipo'];
$id_usuario = $_SESSION['id'];

if (isset($_POST['apagar_tudo'])) {

    if ($tipo == "superadmin") {
        // superadmin apaga tudo
        $sql_delete = "DELETE FROM registros_ad";
    } else {

        $sql_delete = "DELETE FROM registros WHERE id_usuario = $id_usuario";
    }

    if ($conn->query($sql_delete) === TRUE) {
        echo "<p style='color:green;'>Registos apagados com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro ao apagar: " . $conn->error . "</p>";
    }
}

if ($tipo == "superadmin") {
    $sql = "SELECT * FROM registros_ad ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM registros WHERE id_usuario = $id_usuario ORDER BY id DESC";
}

$result = $conn->query($sql);
?>

<head>
    
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2ff;
        color: #000000;
        padding: 40px;
    }

    h2 {
        text-align: center;
        color: #000000;
        font-size: 36px;
        margin-bottom: 30px;
    }

    form, a {
        display: block;
        text-align: center;
        margin-bottom: 15px;
    }

    button {
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
        color: #ffffff;
        margin: 5px 0;
    }

    button[name="apagar_tudo"] {
        background-color: #ff4d4d;
    }

    button[name="apagar_tudo"]:hover {
        background-color: #e60000;
    }

    a button {
        background-color: #4da6ff;
    }

    a button:hover {
        background-color: #3399ff;
    }

    ul {
        list-style-type: none;
        padding: 0;
        max-width: 600px;
        margin: 20px auto 0 auto;
    }

    ul li {
        background-color: #ffffff;
        border: 1px solid #4da6ff;
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 6px;
    }

    /* Responsividade */
    @media (max-width: 480px) {
        body {
            padding: 20px;
        }

        h2 {
            font-size: 28px;
        }

        button {
            width: 100%;
            padding: 10px;
        }

        ul li {
            padding: 10px;
        }
    }
</style>

<h2>Lista de Registos</h2>

<form method="POST">
    <button type="submit" name="apagar_tudo"
        onclick="return confirm('Tens a certeza que queres apagar TODOS os teus registos?')"
        style="background:red;color:white;padding:10px;border:none;cursor:pointer;">
        Apagar Tudo
    </button>
</form>

<br>

<a href="pdfad.php" target="_blank">
    <button type="button"
        style="background:blue;color:white;padding:10px;border:none;cursor:pointer;">
        Gerar PDF
    </button>
</a>

<br><br>

<ul>

<?php
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
?>

</ul>

<br>

<a href="<?php echo ($tipo == 'superadmin') ? 'superadmin.php' : 'home.php'; ?>">
    Voltar
</a>

<?php $conn->close(); ?>