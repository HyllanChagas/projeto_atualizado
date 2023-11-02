<head>
    <link rel="stylesheet" href="../public/css/style.css">
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
                    <h2 class="card-title text-center">Criar Conta</h2>
                    <form action="../action/cadas.php" method="POST">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Nome de Usuário</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" required>
                        </div>
                        <div class="mb-3">
                            <label for="confSenha" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" name="confSenha" id="confSenha" required>
                        </div>
                       <button type="submit" name="cadastrar" class="btn btn-primary btn-block">Criar Conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include_once('components/footer.php'); ?>