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

$cliente_id = 1;

if (isset($_POST['agendar_corpo'])) {

    $nome_falecido = $conn->real_escape_string($_POST['nome_falecido']);
    $local         = $conn->real_escape_string($_POST['local']);
    $data_hora     = $_POST['data_hora'];

    $sql = "INSERT INTO agendamento_corpo 
            (nome_falecido, local, data_hora, cliente_id, status)
            VALUES 
            ('$nome_falecido', '$local', '$data_hora', '$cliente_id', 'pendente')";

    $conn->query($sql);
}

if (isset($_POST['agendar_caixao'])) {

    $tipo_caixao = $conn->real_escape_string($_POST['tipo_caixao']);
    $descricao   = $conn->real_escape_string($_POST['descricao']);

    $sql = "INSERT INTO agendamento_caixao 
            (tipo_caixao, descricao, cliente_id, status)
            VALUES 
            ('$tipo_caixao', '$descricao', '$cliente_id', 'pendente')";

    $conn->query($sql);
}

if (isset($_POST['editar_corpo'])) {

    $id = $_POST['id'];
    $nome_falecido = $conn->real_escape_string($_POST['nome_falecido']);
    $local = $conn->real_escape_string($_POST['local']);
    $data_hora = $_POST['data_hora'];

    $sql = "UPDATE agendamento_corpo 
            SET nome_falecido='$nome_falecido',
                local='$local',
                data_hora='$data_hora'
            WHERE id=$id AND cliente_id=$cliente_id";

    $conn->query($sql);
}

if (isset($_POST['editar_caixao'])) {

    $id = $_POST['id'];
    $tipo_caixao = $conn->real_escape_string($_POST['tipo_caixao']);
    $descricao = $conn->real_escape_string($_POST['descricao']);

    $sql = "UPDATE agendamento_caixao 
            SET tipo_caixao='$tipo_caixao',
                descricao='$descricao'
            WHERE id=$id AND cliente_id=$cliente_id";

    $conn->query($sql);
}

if (isset($_POST['eliminar_corpo'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM agendamento_corpo 
            WHERE id=$id AND cliente_id=$cliente_id";

    $conn->query($sql);
}

if (isset($_POST['eliminar_caixao'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM agendamento_caixao 
            WHERE id=$id AND cliente_id=$cliente_id";

    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Cliente</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f2ff; /* azul claro suave */
        margin: 0;
        padding: 20px;
        color: #000000;
    }



    h2{
        text-align: center;
        font-size: 40px;
    }

    .container {
        max-width: 900px;
        margin: auto;
    }

    .box {
        background-color: #ffffff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    input, select, textarea {
        width: 98%;
        padding: 10px;
        margin-top: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 5px rgba(77,166,255,0.5);
    }

    button {
        padding: 10px;
        width: 100%;
        background-color: #4da6ff; /* azul claro */
        color: #ffffff;
        border: none;
        border-radius: 6px;
        margin-top: 10px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    button:hover {
        background-color: #3399ff;
    }

    table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #4da6ff;
        padding: 8px;
        text-align: left;
        border-radius: 4px;
    }

    th {
        background-color: #4da6ff;
        color: #ffffff;
    }

    td {
        background-color: #ffffff;
    }    

    @media (max-width: 600px) {
        .box {
            padding: 15px;
        }

        input, select, textarea, button {
            padding: 8px;
        }
    }
</style>
</head>

<body>

<div class="container">
    <h2>Painel do Cliente</h2>
    <div class="box">
        <h3>Agendar Corpo</h3>
        <form method="POST">
            <input type="text" name="nome_falecido" placeholder="Nome do falecido, BI e número de telemóvel dos familiares" required>
            <input type="text" name="local" placeholder="Local" required>
            <input type="datetime-local" name="data_hora" required>
            <button name="agendar_corpo">Agendar</button>
        </form>
    </div>

    <div class="box">
        <h3>Agendar Caixão</h3>
        <form method="POST">
            <select name="tipo_caixao" required>
                <option value="">Tipo de caixão</option>
                <option value="simples">Simples</option>
                <option value="medio">Médio</option>
                <option value="premium">Premium</option>
            </select>
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <button name="agendar_caixao">Agendar</button>
        </form>
    </div>

    <div class="box">
        <h3>Lista Agendamento de Corpos a Espera de Atendimento</h3>
        <table>
            <tr>
                <th>Falecido</th>
                <th>Local</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>

            <?php
            $sql = "SELECT * FROM agendamento_corpo WHERE cliente_id = $cliente_id";
            $res = $conn->query($sql);

            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                <form method='POST'>
                    <td><input type='text' name='nome_falecido' value='{$row['nome_falecido']}'></td>
                    <td><input type='text' name='local' value='{$row['local']}'></td>
                    <td><input type='datetime-local' name='data_hora' value='{$row['data_hora']}'></td>
                    <td>{$row['status']}</td>
                    <td>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='editar_corpo'>Salvar</button>
                        <button name='eliminar_corpo' style='background:red;'>Eliminar</button>
                    </td>
                </form>
                </tr>";
            }
            ?>
        </table>
    </div>

    <div class="box">
        <h3>Lista de Agendamento de Caixões a Espera de Atendimento</h3>
        <table>
            <tr>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>

            <?php
            $sql = "SELECT * FROM agendamento_caixao WHERE cliente_id = $cliente_id";
            $res = $conn->query($sql);

            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                <form method='POST'>
                    <td><input type='text' name='tipo_caixao' value='{$row['tipo_caixao']}'></td>
                    <td><input type='text' name='descricao' value='{$row['descricao']}'></td>
                    <td>{$row['status']}</td>
                    <td>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button name='editar_caixao'>Salvar</button>
                        <button name='eliminar_caixao' style='background:red;'>Eliminar</button>
                    </td>
                </form>
                </tr>";
            }
            ?>
        </table>
    </div>
</div><br>
<center><a href="index.php">Sair</a><p>Obs: Após fazer o agendamento, aguarde o nosso contacto que dura um periodo de 24h.</p></center>
</body>
</html>

<?php $conn->close(); ?>