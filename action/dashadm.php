<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['nome']) ) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'];

require_once('../class/crud.php');
require_once('../database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$crud = new CrudProduto($db);

// Solicitações do usuário
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read(); // atualiza a variável $rows após a criação de um novo registro
            break;
        case 'read':
            $rows = $crud->read();
            break;
        default:
            $rows = $crud->read();
            break;
    }
} else {
    $rows = $crud->read();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ADM</title>
	
	<link rel="stylesheet" href="../public/css/style.css" crossorigin="anonymous">
   

</head>

<body>
<nav>
    <img src="../public/foto_produto/logo.jpg" width="100" height="100">
    </nav>
  
    <div class="container mt-5">  
        <h1 class="text-center">Seja bem-vindo <?php echo $nome ?></h1>
        <p class="text-center">Painel de Controle do ADM</p>
        <a href="des.php" class="btn btn-danger float-right">Sair</a>

        <form method="POST" action="?action=create" enctype="multipart/form-data" class="mt-5">
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do serviço</label>
                <input type="text" name="nome_produto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outros">Outros</option>
                </select>
            </div><br>
			<div class="mb-3">
                <label for="preco" class="form-label">Preço do Produto</label>
                <input type="number" name="preco" class="form-control" required>
            </div><br>

            <div class="mb-3">
                <label for="foto_produto" class="form-label">Foto do Produto</label>
                <input type="file" name="foto_produto" class="form-control">
            </div><br>
            <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
        </form>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome do Produto</th>
                    <th>Tipo</th>
                    <th>Caminho Imagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($rows)) {
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id_produto'] . "</td>";
                        echo "<td>" . $row['nome_produto'] . "</td>";
                        echo "<td>" . $row['foto_produto'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Não há registros a serem exibidos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>