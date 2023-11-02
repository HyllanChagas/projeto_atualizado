<!DOCTYPE html>
<html>
<head>
    <title>Agendamento de Cortes</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<nav>
        <img src="../public/foto_produto/logo.jpg" width="100" height="100">
    </nav>
    <h1>Agendamento de Cortes de Cabelo</h1>

    <?php
    session_start();

    require_once('../class/Usuario.php');
    require_once('../database/conexao.php');
    
    $database = new Conexao();
    $db = $database->getConnection();
    $classUsuario = new Usuario($db);
    
    $produto = null;
    
    
    // Verifica se um ID de produto foi passado via GET
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    
        // Consulta SQL para buscar informações do produto pelo ID
        $sql = "SELECT * FROM corte WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Produto não encontrado.";
            exit();
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Conectar ao banco de dados (substitua com suas credenciais)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "client";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $horario = $_POST["hora"];
        $dia = $_POST["dia"];
        $nome_cliente = $_POST["nome"];

        // Verificar se o horário está ocupado para o dia específico
        $sql = "SELECT * FROM agend WHERE dia = '$dia' AND hora = '$hora'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<p>Desculpe, $hora no dia $dia já está ocupado. Por favor, escolha outro horário ou dia.</p>";
        } else {
            // Agendar o corte
            $sql = "INSERT INTO agend (dia, horario, nome) VALUES ('$dia', '$hora', '$nome')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Agendamento para $nome no dia $dia às $hora confirmado.</p>";
            }
        }

        $conn->close();
    }
    ?>

    <p>Agende um Corte</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="dia">Dia:</label>
        <input type="date" name="dia" required>
        <br>
        <label for="horario">Horário:</label>
        <input type="time" name="hora" required>
        <br>
        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" name="nome" required>
        <br>
        <button type="submit">Agendar</button>
    </form>
    <?php include_once('components/foot.php'); ?>
</body>
</html>