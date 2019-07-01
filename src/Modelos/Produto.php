<?php

namespace catira\Modelos;

use catira\Util\Conexao;
use catira\Util\Sessao;
use catira\Modelos\Produto;
use catira\Entidades\ProdutoEnt;
use catira\Controladores\ControladorProduto;
use PDO;

class Produto {

    public function cadastrarProduto($produto) {
        $sql = 'insert into produtos (nome_prod, descricao_prod,categoria_prod,desejo_troca,caminho_img,vendedor,data) '
                . 'values(:nome, :descricao, :categoria, :troca, :caminho_img, :vendedor, :data)';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':nome', $produto->getNome());
        $p_sql->bindValue(':descricao', $produto->getDescricao());
        $p_sql->bindValue(':categoria', $produto->getCategoria());
        $p_sql->bindValue(':troca', $produto->getDescricao_troca());
        $p_sql->bindValue(':caminho_img', $produto->getCaminho_img());
        $p_sql->bindValue(':vendedor', $produto->getVendedor());
        $p_sql->bindValue(':data', $produto->getData());
        if ($p_sql->execute()) {
            echo "cadastrado";
        }
    }
    public function alterarProduto($id,$produto) {
        $sql = 'UPDATE produtos SET nome_prod=:nome, descricao_prod=:descricao, categoria_prod=:categoria, '
                . 'desejo_troca=:troca, caminho_img=:caminho_img WHERE id_prod=:id';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id', $id);
        $p_sql->bindValue(':nome', $produto->getNome());
        $p_sql->bindValue(':descricao', $produto->getDescricao());
        $p_sql->bindValue(':categoria', $produto->getCategoria());
        $p_sql->bindValue(':troca', $produto->getDescricao_troca());
        $p_sql->bindValue(':caminho_img', $produto->getCaminho_img());
        if ($p_sql->execute()) {
            echo "alterado";
        }
    }
    
    public function excluirProduto($id){
         $sql = "delete from produtos where id_prod=$id";
         $p_sql = Conexao::getInstancia()->prepare($sql);
         if ($p_sql->execute()) {
            return;
        }else{
            echo 'ERRO ao conectar';
        }
    }
    
    public function inserirPergunta($idProd, $mensagem, $nome){
      $sql = "INSERT INTO perguntas (id_perguntaa_prod, mensagem, nome_usuario) VALUES ($idProd, '$mensagem', '$nome')";
      $p_sql = Conexao::getInstancia()->prepare($sql);
      if ($p_sql->execute()) {
            return;
        }else{
            echo 'ERRO ao conectar';
        }
    }

    public function listaTodosProdutos() {
        try {
            $sql = "SELECT * FROM produtos";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    
    public function listarProdutosPorEmail($email) {
        try {
            $sql = "SELECT * FROM produtos where vendedor = '$email' order by id_prod desc";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    public function buscarProdutoPorID($id) {
        try {
            $sql = "SELECT * FROM produtos where id_prod = $id";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    
    public function buscarProdutosPorNome($nome) {
        try {
            $sql = "SELECT * FROM produtos where nome_prod like '%$nome%'";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    

    public function getQuantidadeProdutos() {
        try {
            $sql = "SELECT count(*) as qtdProd FROM produtos";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    
    public function getQuantidadeProdutosPorCategoria($idCat) {
        try {
            $sql = "SELECT count(*) as qtdProd FROM produtos where categoria_prod=$idCat";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    public function listarProdutosPorPagina($pagina) {
        try {
            $qtdProdutosPorPagina = 16;
            $inicio = $qtdProdutosPorPagina * $pagina - $qtdProdutosPorPagina;

            $sql = "SELECT * FROM produtos order by id_prod desc limit $inicio, $qtdProdutosPorPagina";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    public function listarProdutosPorCategoria($pagina, $categoria) {
        try {
            $qtdProdutosPorPagina = 16;
            $inicio = $qtdProdutosPorPagina * $pagina - $qtdProdutosPorPagina;
            $sql = "SELECT produtos.* FROM produtos,categorias where categoria_prod=id_cat and id_cat=$categoria "
                    . "order by id_prod desc limit $inicio, $qtdProdutosPorPagina";
            //$sql = "SELECT * FROM produtos order by id_prod desc limit $inicio, $qtdProdutosPorPagina";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    public function listarCategorias() {
        try {
            $sql = "SELECT * FROM catira.categorias";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }
    public function listarMensagens($id) {
        try {
            $sql = "SELECT * FROM perguntas where id_perguntaa_prod = $id order by id_pergunta desc";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

}
