<?php

namespace catira\Controladores;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use catira\Modelos\Usuario;
use catira\Entidades\Cliente;
use catira\Modelos\Produto;
use Twig\Environment;
use catira\Util\Sessao;
use catira\Controladores\ControladorTelas;

class ControladorUsuarios {

    private $response;
    private $contexto;
    private $twig;
    private $sessao;

    public function __construct(Response $response, Request $contexto, Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
        $this->sessao = $sessao;
    }

    public function logar() {

        $email = $this->contexto->get('email');
        $senha = $this->contexto->get('senha');
        $senha = md5($senha);
        $modelo = new Usuario();
        $modelo->logar($email, $senha);
        
    }

    public function logout() {
        $_SESSION['nome'] = '';
        $nomeSessao = 'FAZER LOGIN';
        echo "<script>window.location='/'</script>";
    }

    public function cadastrar() {
        $email = $this->contexto->get('email');

        $senha = $this->contexto->get('senha');
        $csenha = $this->contexto->get('csenha');
        $nome = $this->contexto->get('nome');
        $logradouro = $this->contexto->get('logradouro');
        $numero = $this->contexto->get('numero');
        $cidade = $this->contexto->get('cidade');
        $estado = $this->contexto->get('estado');
        $cep = $this->contexto->get('cep');
        $telefone = $this->contexto->get('telefone');

//        if ($email == ''||$email == null||$senha == ''||$senha == null||$csenha == ''||$csenha == null||
//                $nome == ''||$nome == null||$logradouro == ''||$logradouro == null||$numero == ''||$numero == null||
//                $cidade == ''||$cidade == null||$estado == ''||$estado == null||$cep == ''||$cep == null||$telefone == ''||$telefone == null
//        ) {
//            echo "Todos os campos devem ser preenchidos!";
//        } else {
        if ($senha == $csenha) {
            $senha = md5($senha);
            $cliente = new Cliente($nome, $email, $senha, $logradouro, $numero, $cidade, $estado, $cep, $telefone);
            $usuarioCadastrar = new Usuario();
            $usuarioCadastrar->cadastrar($cliente);
        } else {
            echo "senhas não conferem";
        }
        //}
    }

    public function alterarDados() {
        $email = $this->sessao->get('email');
        $senha = '';
        $nome = $this->contexto->get('nome');
        $logradouro = $this->contexto->get('logradouro');
        $numero = $this->contexto->get('numero');
        $cidade = $this->contexto->get('cidade');
        $estado = $this->contexto->get('estado');
        $cep = $this->contexto->get('cep');
        $telefone = $this->contexto->get('telefone');

        $cliente = new Cliente($nome, $email, $senha, $logradouro, $numero, $cidade, $estado, $cep, $telefone);
        $usuarioAlt = new Usuario();
        $usuarioAlt->alterar($cliente);

        return;
    }

    public function alterarSenha() {
        $senha = $this->contexto->get('senha');
        $senha = md5($senha);
        $emailUsuario = $this->sessao->get('email');
        $usuarioAlt = new Usuario();
        $usuarioAlt->alterarSenha($senha, $emailUsuario);
    }

}

?>