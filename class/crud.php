<?php
include('../database/conexao.php');

$db = new Conexao();

class CrudProduto{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($postValue){
        $nome_produto = $postValue['nome_produto'];
        $preco = $postValue['preco'];


        if(isset($_FILES['foto_produto'])){
            $arquivo = $_FILES['foto_produto'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    
            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_arquivo = '../public/foto_produto/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_arquivo = ''; // Se nenhum arquivo foi enviado, defina o caminho como vazio
        }
        

        $query = "INSERT INTO corte (nome_produto, preco, foto_produto) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$nome_produto);
        $stmt->bindParam(2,$preco);
        $stmt->bindParam(3,$caminho_arquivo);


        $rows = $this->read();
        if($stmt->execute()){
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print"<script>  location.href='?action=read';</script>";
            return true;
        }else{
            return false;
        }

    }


    public function read(){
        $query = "SELECT * FROM corte";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}


?>