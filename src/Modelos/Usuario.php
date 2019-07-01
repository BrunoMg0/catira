<?php

namespace catira\Modelos;

use catira\Util\Conexao;
use catira\Util\Sessao;
use catira\Modelos\Usuario;
use catira\Controladores\ControladorUsuarios;
USE PDO;

class Usuario {

    public function logar($usuario, $senha) {
        $sql = "select * from usuarios where email_usuario = :usuario and senha_usuario = :senha";

        $p_sql = Conexao::getInstancia()->prepare($sql);

        $p_sql->bindValue(':usuario', $usuario);
        $p_sql->bindValue(':senha', $senha);

        $p_sql->execute();
        $resultado = $p_sql->fetch(PDO::FETCH_ASSOC);
        $numero_de_linhas = $p_sql->rowCount();

        if ($numero_de_linhas > 0) {
            $sessao = new Sessao();
            //$sessao->start();
            $sessao->add('nome', $resultado["nome_usuario"]);
            $sessao->add('email', $resultado["email_usuario"]);
            echo 'logado';
        } else {
            echo'Email ou senha inválidos!';
            //return null;
        }
    }

    public function buscarUsuarioporEmail($email) {
        try {
            $sql = "SELECT * FROM usuarios where email_usuario = '$email'";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    public function verificaEmail($email) {
        $sql = 'select * from usuarios where email_usuario = :email';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':email', $email);
        $p_sql->execute();
        $numero_de_linhas = $p_sql->rowCount();
        if ($numero_de_linhas > 0) {
            return true;
        }
        return false;
    }

    public function cadastrar($usuario) {
        try {
            $existeEmail = Usuario::verificaEmail($usuario->getEmail());
            if ($existeEmail) {
                echo "Esse email já está cadastrado!";
                return null;
            } else {
                $sql = 'insert into usuarios (nome_usuario, email_usuario,senha_usuario,logradouro,numero,cidade,estado,cep,telefone) '
                        . 'values(:nome, :email, :senha, :logradouro, :numero, :cidade, :estado, :cep, :telefone)';
                $p_sql = Conexao::getInstancia()->prepare($sql);
                $p_sql->bindValue(':nome', $usuario->getNome());
                $p_sql->bindValue(':email', $usuario->getEmail());
                $p_sql->bindValue(':senha', $usuario->getSenha());
                $p_sql->bindValue(':logradouro', $usuario->getLogradouro());
                $p_sql->bindValue(':numero', $usuario->getNumero());
                $p_sql->bindValue(':cidade', $usuario->getCidade());
                $p_sql->bindValue(':estado', $usuario->getEstado());
                $p_sql->bindValue(':cep', $usuario->getCep());
                $p_sql->bindValue(':telefone', $usuario->getTelefone());
                if ($p_sql->execute()) {
                    $email = $usuario->getEmail();
                    $senha = $usuario->getSenha();
                    Usuario::logar($email, $senha);
                    echo "cadastrado";
                }
                return null;
            }
        } catch (Exception $ex) {
            echo 'Erro na conexão:' . $ex;
        }
    }

    public function alterar($usuario) {
        try {
            $sql = 'UPDATE usuarios SET nome_usuario=:nome, logradouro=:logradouro, '
                    . 'numero=:numero, cidade=:cidade, estado=:estado, cep=:cep, telefone=:telefone WHERE email_usuario=:email';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $usuario->getNome());
            $p_sql->bindValue(':email', $usuario->getEmail());
            $p_sql->bindValue(':logradouro', $usuario->getLogradouro());
            $p_sql->bindValue(':numero', $usuario->getNumero());
            $p_sql->bindValue(':cidade', $usuario->getCidade());
            $p_sql->bindValue(':estado', $usuario->getEstado());
            $p_sql->bindValue(':cep', $usuario->getCep());
            $p_sql->bindValue(':telefone', $usuario->getTelefone());
            if ($p_sql->execute()) {
                $nomeUsuario = $usuario->getNome();
                $sessao = new Sessao();
                $sessao->remove('nome');
                $sessao->add('nome', $nomeUsuario);
                echo "Alterado";
            }
            return null;
        } catch (Exception $ex) {
            echo 'Erro na conexão:' . $ex;
        }
    }

    public function alterarSenha($senha, $email) {
        try {
            $sql = 'UPDATE usuarios SET senha_usuario=:senha WHERE email_usuario=:email';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':senha', $senha);
            $p_sql->bindValue(':email', $email);
            if ($p_sql->execute()) {
                echo "Alterado";
            }
            return null;
        } catch (Exception $ex) {
            echo 'Erro na conexão:' . $ex;
        }
    }

}
