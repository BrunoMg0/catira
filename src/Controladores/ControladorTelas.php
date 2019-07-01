<?php

namespace catira\Controladores;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use catira\Modelos\Usuario;
use catira\Modelos\Produto;
use Twig\Environment;
use catira\Util\Sessao;

class ControladorTelas {

    private $response;
    private $contexto;
    private $twig;
    private $sessao;

    /*
      function __construct(Response $response, Environment $twig) {
      $this->response = $response;
      $this->twig = $twig;

      } */

    public function __construct(Response $response, Request $contexto, Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
        $this->sessao = $sessao;
    }

    public function retornarNomeSessao() {
        if (isset($_SESSION['nome'])) {
            $nomeSessao = $_SESSION['nome'];
        } else {
            $nomeSessao = 'FAZER LOGIN';
        }
        return $nomeSessao;
    }

    public function telaInicial() {
        $modelo = new Produto;
        $qtdprodutos = $modelo->getQuantidadeProdutos();
        $qtdprodutos = $qtdprodutos['qtdProd'];
        $this->sessao->add('qtdprodutos', $qtdprodutos);
        $pagina = 1;
        $this->sessao->add('pagina', $pagina);
        $produtos = $modelo->listarProdutosPorPagina($pagina);
        $categorias = $modelo->listarCategorias();

        $nomeSessao = $this::retornarNomeSessao();

        $prodPorPagCat = 'nao';

        return $this->response->setContent($this->twig->render('index.html', ['nome' => $nomeSessao, 'produtos' => $produtos,
                            'qtdprodutos' => $qtdprodutos, 'pagina' => $pagina, 'categorias' => $categorias, 
            'prodPorPagCat' => $prodPorPagCat, 'titulo' => "Home"]));
    }

    public function telaProduto($id) {

        $aux = new Produto;

        $produto = $aux->buscarProdutoPorID($id);

        $nomeSessao = $this::retornarNomeSessao();

        $categorias = $aux->listarCategorias();

        $perguntas = $aux->listarMensagens($id);

        $this->sessao->add('idProdutoAtual', $id);

        return $this->response->setContent($this->twig->render('produto.html', ['produto' => $produto,
                            'nome' => $nomeSessao, 'categorias' => $categorias, 'perguntas' => $perguntas, 'titulo' => "Anúncio"
        ]));
    }

    public function telaCadProd() {
        $nomeSessao = $this::retornarNomeSessao();
        if ($nomeSessao == '' || $nomeSessao == 'FAZER LOGIN') {
            echo 'Você deve fazer o login!';
            return;
        } else {
            $img = "a.png";
            $aux = new Produto;
            $categorias = $aux->listarCategorias();
            return $this->response->setContent($this->twig->render('cadastroProdutos.html', [
                                'nome' => $nomeSessao, 'nomeimg' => $img, 'categorias' => $categorias, 'titulo' => "Anunciar"
            ]));
        }
    }

    public function telaEditarProd($id) {
        $nomeSessao = $this::retornarNomeSessao();
        //$id = $this->contexto->get('idProd');

        if ($nomeSessao == '' || $nomeSessao == 'FAZER LOGIN') {
            echo 'Você deve fazer o login!';
            return;
        } else {
            $aux = new Produto;
            $categorias = $aux->listarCategorias();
            $produto = $aux->buscarProdutoPorID($id);
            $img = $produto['caminho_img'];


            return $this->response->setContent($this->twig->render('editarProduto.html', [
                                'nome' => $nomeSessao, 'nomeimg' => $img, 'categorias' => $categorias, 'produto' => $produto
            ]));
        }
    }

    public function mostrarTelaAnuncios() {
        $nomeSessao = $this::retornarNomeSessao();
        $modelo = new Produto;
        $categorias = $modelo->listarCategorias();
        $emailUsuarioLogado = $this->sessao->get('email');
        $produtos = $modelo->listarProdutosPorEmail($emailUsuarioLogado);

        return $this->response->setContent($this->twig->render('meusAnuncios.twig', ['produtos' => $produtos,
                            'categorias' => $categorias, 'nome' => $nomeSessao, 'titulo' => "Meus Anúncios"]));
    }

    public function mostrarTelaDados() {
        $nomeSessao = $this::retornarNomeSessao();
        if ($nomeSessao == '' || $nomeSessao == 'FAZER LOGIN') {
            echo 'Você deve fazer o login!';
            return;
        } else {
            $prod = new Produto;
            $user = new Usuario;
            $categorias = $prod->listarCategorias();
            $emailUsuarioLogado = $this->sessao->get('email');
            $usuario = $user->buscarUsuarioPorEmail($emailUsuarioLogado);


            return $this->response->setContent($this->twig->render('meusDados.html', [
                                'nome' => $nomeSessao, 'categorias' => $categorias, 'usuario' => $usuario, 'titulo' => "Meus Dados"
            ]));
        }
    }

    public function mostrarTelaContatos() {
        $modelo = new Produto;
        $categorias = $modelo->listarCategorias();
        return $this->response->setContent($this->twig->render('contato.html', ['categorias' => $categorias, 'titulo' => "Contatos"]));
    }

    public function abrirCadastro() {
        $modelo = new Produto;
        $categorias = $modelo->listarCategorias();
        return $this->response->setContent($this->twig->render('cadastro.html', ['categorias' => $categorias, 'titulo' => "Cadastro"]));
    }

    public function telaLogin() {
        $modelo = new Produto;
        $categorias = $modelo->listarCategorias();
        return $this->response->setContent($this->twig->render('login.twig', ['categorias' => $categorias, 'titulo' => "Login"]));
    }

    public function exibirDiv() {
        $id = $this->contexto->get('idProd');
        $modelo = new Produto;
        $produto = $modelo->buscarProdutoPorID($id);
        return $this->response->setContent($this->twig->render('divApagar.html', ['produto' => $produto]));
    }

}

?>