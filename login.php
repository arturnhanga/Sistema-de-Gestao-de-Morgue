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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $senha    = $_POST['senha'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, senha, tipo FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if ($senha === $row['senha']) {

            $_SESSION['id']   = $row['id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['tipo'] = $row['tipo'];

            if ($row['tipo'] === "superadmin") {
                header("Location: superadmin.php");
            } 
            else if ($row['tipo'] === "admin") {
                header("Location: home.php");
            }
            else {
                header("Location: usuario.php");
            }
            exit();
        } else {
            echo "<p style='color:red;'>Senha incorreta!</p>";
        }
    } else {
        echo "<p style='color:red;'>Usuário não encontrado!</p>";
    }
}
?>

<head>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<h2>Sistema de Gestão de Morgue</h2><br><br>
<div class="form">
<fieldset>
    <legend>Login</legend>
<form method="POST"><br>
    <input type="text" name="username" placeholder="Username">
    <br><br><input type="password" name="senha" placeholder="Senha"><br><br>
    <button type="submit">Entrar</button>
</form>
</fieldset>
</div>
<a href="index.php">voltar</a>
<style>
    
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    background: #e6f2ff; 
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

h2{
    color: #39393a;
    margin-bottom:30px;
    font-size:3rem;
    text-align:center;
}

.form{
    width:100%;
    display:flex;
    justify-content:center;
}

fieldset{
    width:380px;
    padding:30px;
    border:none;
    background: rgba(255,255,255,0.9);
    border-radius:15px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}

legend{
    color:#4da6ff; /* destaque azul */
    font-size:1.2rem;
    font-weight:bold;
    padding:0 10px;
    text-align:center;
}

input{
    width:100%;
    padding:14px;
    border:none;
    border-radius:8px;
    outline:none;
    margin-top:10px;
    background:#ffffff;
    color:#000000;
    font-size:1rem;
    transition:0.3s;
}

input:focus{
    border:2px solid #4da6ff;
    box-shadow: 0 0 5px rgba(77,166,255,0.5);
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:8px;
    background:#4da6ff;
    color:#ffffff;
    font-size:1rem;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
    margin-top:15px;
}

button:hover{
    background:#3399ff;
    transform:translateY(-2px);
}

/* Responsividade */
@media(max-width:500px){
    h2{
        font-size:1.8rem;
        padding:0 20px;
    }

    fieldset{
        width:90%;
    }
}

</style>