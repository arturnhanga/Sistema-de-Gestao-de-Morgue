<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['tipo'] !== 'superadmin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "morgue");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_GET['deletar'])) {
    $id_delete = intval($_GET['deletar']);
    $sql_del = "DELETE FROM usuarios WHERE id = $id_delete AND tipo='admin'";

    if ($conn->query($sql_del) === TRUE) {
        echo "<p style='color:green;'>Admin eliminado com sucesso!</p>";

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p style='color:red;'>Erro ao eliminar admin: " . $conn->error . "</p>";
    }
}

if (isset($_POST['criar_admin'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios (username, senha, tipo)
            VALUES ('$username', '$senha', 'admin')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Admin criado com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro ao criar admin: " . $conn->error . "</p>";
    }
}
?>

<h2>Gestão de Administradores</h2>
<hr>

<h3>Criar Novo Admin</h3>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="text" name="senha" placeholder="Senha" required><br><br>
    <button type="submit" name="criar_admin">Criar Admin</button>
</form>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2ff; /* azul claro suave */
        color: #000000;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #000000;
        margin-bottom: 10px;
        font-size: 48px;
    }

    h3 {
        color: #000000;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    hr {
        border: 0;
        border-top: 2px solid #4da6ff;
        margin-bottom: 30px;
    }

    form {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 10px;
        max-width: 400px;
        margin: 0 auto;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    input[type="text"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input[type="text"]:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 5px rgba(77, 166, 255, 0.5);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #4da6ff;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #3399ff;
    }

    /* Responsividade */
    @media (max-width: 480px) {
        form {
            padding: 20px;
        }

        input[type="text"], button[type="submit"] {
            padding: 10px;
        }
    }
</style>

<hr>

<h3>Admins Existentes</h3>
<?php
$result = $conn->query("SELECT * FROM usuarios WHERE tipo='admin'");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #000; padding:10px; margin:10px;'>";
        echo "ID: " . $row['id'] . "<br>";
        echo "Username: " . $row['username'] . "<br>";
        echo "<a href='?deletar=" . $row['id'] . "' 
                    onclick=\"return confirm('Tens certeza que queres eliminar este admin?')\" 
                    style='color:red; text-decoration:none;'>Eliminar</a>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum admin encontrado.</p>";
}
?>

<hr>
<center><a href="superadmin.php">Voltar</a></center>