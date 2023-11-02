<?php
include_once('db.php');
$host = "localhost";
$username = "root";
$password = "";
$database = "client";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $validade = $_POST['validade'];
    $cvv = $_POST['cvv'];

    // Insira os dados no banco de dados
    $sql = "INSERT INTO card (nome, numero, validade, cvv) VALUES ('$nome', '$numero', '$validade', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "Pagamento registrado com sucesso!";
    } else {
        echo "Erro ao registrar pagamento: " . $conn->error;
    }
}
?>

?>
