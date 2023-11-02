<?php
session_start();

require_once('../class/Usuario.php');
require_once('../database/conexao.php');
require_once('../class/Carrinho.php');

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


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    
    <link rel="stylesheet" href="../public/css/style.css" crossorigin="anonymous">
</head>
<body>
    <?php include_once('../view/components/nav.php'); ?>

    <div class="container">
        <h1>Seu Carrinho</h1>

        <?php
        $carrinho = new Carrinho(
            $id_produto,
            $produtos[$id_produto]['nome_produto'],
            $produtos[$id_produto]['descricao'],
            $produtos[$id_produto]['preco'],
            $produtos[$id_produto]['foto_produto']
        );

        $carrinho->getCarrinho();

        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $produto => $value) {
                ?>
                <div class="product-card">
                    <img src="<?= $value['foto_produto'] ?>" alt="Imagem do Produto">
                    <div class="product-details">
                        <div class="product-title"><?= $value['nome_produto'] ?></div>
                        <div class="product-price">Preço: R$ <?php $value['preco'] ?></div>
                        <div class="remove-button" data-id="<?= $produto ?>">Remover</div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="empty-cart-message">Seu carrinho está vazio.</div>';
        }
        
        ?>


    </div>

    <script>
        $(document).ready(function () {
            $(".remove-button").click(function () {
                var idProduto = $(this).data("id");

                $.ajax({
                    url: "../action/exc.php",
                    type: "POST",
                    data: { id_produto: idProduto },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>
</body>
<?php include_once('components/foote.php'); ?>
</html>