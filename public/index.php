<?php
session_start();

require_once('../class/usuario.php');
require_once('../database/conexao.php');


$database = new Conexao();
$db = $database->getConnection();
$classNome = new Usuario($db);


$produtos = [];

$query = "SELECT * FROM corte ";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $row;
    }
}

$id_produto = isset($_GET['id_produto'])?$_GET['id_produto']:"";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salão de Beleza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php  include_once('../view/components/nav.php'); ?>
    <header id="topo">
        <h1 class="titulo">Salão Profissional</h1>
        <p class="titulo">É um espaço essencial em muitos setores e indústrias, desempenhando um papel crucial no apoio a uma variedade de atividades e serviços. Esses locais são projetados para atender às necessidades de profissionais qualificados e oferecem um ambiente adequado para a realização de diversas tarefas, desde cortes de cabelo e tratamentos de beleza até reuniões de negócios e eventos de treinamento.</p>
        <h1 class="sub">Sobre</h1>
        <p class="sub">Hair Saloon é um salão de beleza fictício localizado em Curitiba, uma pequena cidade. Evilin, a proprietária, criou um ambiente acolhedor e amigável onde não apenas transforma a aparência de seus clientes, mas também promove a autoestima e a confiança. O salão se tornou um pilar na comunidade, ajudando as pessoas a aceitar e abraçar sua singularidade e a compartilhar histórias de transformação. O salão é mais do que um local de beleza, é um refúgio de autoestima, inspiração e comunidade.</p>
    </header>
    <br>    
    <a href="../view/contato.php" class="botao">Entre em contato</a><br>

    <div class="services">
    <h2>Venha conhecer</h2>
    <p id="cphMasterPortal_pEndereco">
						<a id="cphMasterPortal_hlkEnderecoGoogle" class="linkExterno" href="https://www.google.com/maps/search/?api=1&amp;query=R.+JO%c3%83O+MIQUELETTO%2c+1500+Alto+Boqueir%c3%a3o%2c+Curitiba+-+PR">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7198.778953686178!2d-49.2343419!3d-25.55870595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcf98f2f7c9d91%3A0x2918348a71cd9422!2sRua%20Jo%C3%A3o%20Miqueletto%2C%201500%20-%20Alto%20Boqueir%C3%A3o%2C%20Curitiba%20-%20PR%2C%2081860-270!5e0!3m2!1spt-BR!2sbr!4v1695338070997!5m2!1spt-BR!2sbr"  width="1000" height="500" style="border:0;" _blank>Abrir no Google Maps<span class="icon-linkDireto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></span></a></iframe>

					</p>
					
  </div>

   <?php include_once('../view/components/foo.php'); ?>
</body>
</html>