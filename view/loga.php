<?php
session_start();

require_once('../class/usuario.php');
require_once('../database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

if (isset($_POST['logar'])) { // Verifique se o formulário foi submetido
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Adicione validação básica aqui, por exemplo, verifique se o email e senha não estão vazios.

    if ($classUsuario->logar($email, $senha)) {
        if ($classUsuario->verificarAdm($email)) {
            $query = "SELECT nome FROM client WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nome = $row['nome'];

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            header("Location: ../action/dashadm.php");
            exit();
        } else {
            $query = "SELECT nome FROM client WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nome = $row['nome'];

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            header("Location: servicos.php");
            exit();
        }
    } else {
        echo "<script>alert('Login inválido')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/style.css" crossorigin="anonymous">
</head>

<body>
    <nav>
        <img src="../public/foto_produto/logo.jpg" width="100" height="100">
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" required>
                            </div>
                            <button type="submit" name="logar" class="btn btn-primary btn-block">Logar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include_once('components/footer.php'); ?>

</html>
