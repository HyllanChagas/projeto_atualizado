<?php
include('../database/conexao.php');

$db = new Conexao();

class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cadastrar($nome, $email, $senha, $confSenha) {
        if ($senha === $confSenha) {
            if ($this->verificarExistente($email)) {
                throw new Exception('Email ou Nome de usuário já cadastrado.');
            }

            $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT INTO client (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $senhaCrip);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception('Erro ao cadastrar usuário.');
            }
        } else {
            throw new Exception('As senhas não coincidem.');
        }
    }

    public function verificarExistente($email) {
        $query = "SELECT COUNT(*) FROM client WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function logar($email, $senha) {
        $query = "SELECT id, email, senha FROM client WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $senha_hash = $row['senha'];
            if (password_verify($senha, $senha_hash)) {
                return true;
            }
        }
        return false;
    }

    public function verificarAdm($email) {
        $query = "SELECT adm FROM client WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['adm'] == 1;
        }
        return false;
    }
}
?>