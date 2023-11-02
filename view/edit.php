<?php
    include('../action/cadas.php')
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <nav>
        <img src="../public/foto_produto/logo.jpg" width="100" height="100">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav> 

    <h1>Editar Perfil</h1>
    <p>Email: <?php echo $email; ?></p>
    
    <form method="POST" action="edit.php">
        <label for="novoNome">Novo Nome:</label>
        <input type="text" name="novoNome" value="<?php echo $nome; ?>" required>

        <label for="novaSenha">Nova Senha:</label>
        <input type="password" name="novaSenha" placeholder="Coloque uma nova senha" required>

        <button type="submit" name="atualizar">Atualizar Perfil</button>
    </form>

    <a href="dashboard.php">Voltar para o Dashboard</a>
    <a href="logout.php">Sair</a>
    <?php include_once('components/foot.php'); ?>