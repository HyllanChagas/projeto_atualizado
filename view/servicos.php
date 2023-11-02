<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['nome']) ) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'];

?>
<head>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
    <nav>
        <img src="../public/foto_produto/logo.jpg" width="100" height="100">
    </nav>
    <h1 class="text-center">Seja bem-vindo <?php echo $nome ?></h1>
        <div>
    <section id="servicos">
    <h2>Serviços</h2>
    <div>
        
        <img src="../public/foto_produto/salon.png" alt="Masc" width="75" height="75"><br>
        <a href="../view/cortes.php"><h3>Cortes Masculinos, Femininos e outros</h3></a>
        <p>Os serviços incluem cortes de cabelo masculinos e femininos, coloração, hidratação, entre outros. Os profissionais nesses espaços são especializados em realçar a aparência e a autoestima dos clientes, proporcionando um ambiente onde o cuidado pessoal é prioridade. </p>
    </div>
</section>

<?php include_once('components/footer.php'); ?>