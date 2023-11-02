<?php
session_start();

require_once('../class/Usuario.php');
require_once('../database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

$produtos = [];

$query = "SELECT * FROM corte ";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $row;
    }
}

$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : "";


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortes</title>
    <style>
        body {
        font-family: Nunito, sans-serif;
        color:rgb(0, 0, 0);
        }
        h1{
            text-align: center;
            color: #666;
        }
        nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color:#F6CFCF;
        }
        footer {
        text-align: center;
        padding: 10px;
        background-color:#F6CFCF;
        color: #ffffff;
        }

        footer a {
        text-decoration: none;
        color: #ffffff;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-card {
            width: 24%; /* Ajuste a largura desejada dos cards aqui */
            margin: 10px;
            display: flex;
            flex-direction: column;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            object-fit: contain; /* Para manter a proporção e centralizar a imagem */
        }

        .product-card .card-body {
            padding: 10px;
            text-align: center;
        }

        .product-card h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
        }

        .btn_visu {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <img src="../public/foto_produto/logo.jpg" width="100" height="100">
    </nav>

    <h1>Cortes e outros</h1>
    <div class="container">
    <div class="row">
    <?php
            foreach ($produtos as $produto) {
                echo '<div class="col-md-3 product-card">';
                echo '<div class="card position-relative">';
                echo '<img src="' . $produto["foto_produto"] . '" alt="' . $produto["nome_produto"] . '" class="card-img-top">';
                echo '<div class="card-body">';
                echo '<h2 class="card-title">' . $produto["nome_produto"] . '</h2>';
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="produto_id" value="' . $produto["id_produto"] . '">';
                echo '<p class="produto-preco">Preço: R$ ' . number_format($produto["preco"], 2, ',', '.') . '</p>';
                echo '<a href="tel_ag.php?id_produto=' . $produto["id_produto"] . '" class="btn_visu btn btn-primary">Agendar</a>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
</div>
</body>
<footer>
    <a href="../view/servicos.php">Voltar</a>
    <p>Todos os direitos reservados</p>
</footer>
