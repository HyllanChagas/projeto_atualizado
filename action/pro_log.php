<div class="container">
    <?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "client";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "SELECT * FROM client WHERE email='$email' AND senha='$senha'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: ../action/dashadm.php");
} else {
    echo "Credenciais inválidas.";
}

$conn->close();
?>