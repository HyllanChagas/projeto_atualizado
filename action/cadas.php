<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "client";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if (strlen($senha) < 8) {
        echo "A senha deve ter pelo menos 8 caracteres.";
    } elseif (!preg_match('/[A-Za-z]/', $senha)) {
        echo "A senha deve conter pelo menos 1 letra.";
    } elseif (!preg_match('/[^A-Za-z0-9]/', $senha)) {
        echo "A senha deve conter pelo menos 1 caracter especial.";
    } elseif ($senha != $confSenha) {
        echo "As senhas não coincidem.";
    } else {
        // Insere os dados no banco de dados (lembre-se de escapar os dados para evitar SQL injection)
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO client (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha_hash);

        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!')</script>";
            header("Location: ../view/loga.php");
        } else {
            echo "<script>alert('Erro ao cadastrar: ')</script>"  . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>