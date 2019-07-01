<?php

namespace catira\Controladores;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use catira\Modelos\Produto;
use catira\Entidades\ProdutoEnt;
use Twig\Environment;
use catira\Util\Sessao;
use catira\Controladores\ControladorTelas;

class ControladorProduto {

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

    public function produtosporPagina() {
        $pagina = $this->contexto->get('npage');
        if ($pagina == 'anterior') {
            $pagina = $this->sessao->get('pagina') - 1;
            if ($pagina == 0) {
                echo 'primeira';
                return;
            }
        } 
        if ($pagina == 'prox') {
            $pagina = $this->sessao->get('pagina') + 1;
            
            if ($pagina > $this->contexto->get('ultpg')) {
                echo 'ultima';
                return;
            }
        }

        $this->sessao->add('pagina', $pagina);
        $qtdprodutos = $this->sessao->get('qtdprodutos');

        $modelo = new Produto;
        
        $eProdutosPorCategoria = $this->contexto->get('prodPorPagCat');
       
        if ($eProdutosPorCategoria == 'sim'){
            $categoriaAtual = $this->sessao->get('categoriaAtual');
            $produtos = $modelo->listarProdutosPorCategoria($pagina, $categoriaAtual);
            $prodPorPagCat = 'sim';
        }
         else{
            $produtos = $modelo->listarProdutosPorPagina($pagina);
            $prodPorPagCat = 'nao';
        }
        
        

        return $this->response->setContent($this->twig->render('produtos2.twig', ['produtos' => $produtos, 'pagina' => $pagina, 'qtdprodutos' => $qtdprodutos, 
            'prodPorPagCat'=>$prodPorPagCat
            ]));
    }
    
    public function produtosPorCategoria($idcat){
        
        $this->sessao->add('categoriaAtual', $idcat);
        
        $nomeSessao = $this::retornarNomeSessao();
 
        $pagina = 1;
        

        $modelo = new Produto;
        
        $categorias = $modelo->listarCategorias();

        $produtos = $modelo->listarProdutosPorCategoria($pagina,$idcat);
        
        $qtdprodutos = $modelo->getQuantidadeProdutosPorCategoria($idcat);
        $qtdprodutos = $qtdprodutos['qtdProd'];
        //$this->sessao->add('qtdprodutos', $qtdprodutos);
        
//        if ($qtdprodutos == 0){
//            $qtdprodutos++;
//        }
        
        if (count($produtos) == 0){
            echo '<script>alert(" ' . "Nenhum produto!" . '  ");</script>';
             echo '<script>window.location="/"</script>';;
        };
        
        $prodPorPagCat='sim';
        
        return $this->response->setContent($this->twig->render('index.html', ['nome' => $nomeSessao, 'produtos' => $produtos,
            'qtdprodutos' => $qtdprodutos, 'pagina' => $pagina, 'categorias' => $categorias, 
            'prodPorPagCat' => $prodPorPagCat, 'titulo' => "Categoria" ]));

       
    }


    public function trocarimg(){
        if(isset($_FILES['arquivo'])){
            $nomeimg = $_FILES['arquivo']['name'];
        $temp = $_FILES['arquivo']['tmp_name'];
        
         move_uploaded_file($temp, 'imgs/' . $nomeimg);
         return $this->response->setContent($this->twig->render('imgCad.html', ['nomeimg' => $nomeimg]));
        }
        return;

    }
    
    public function perguntar(){
        $pergunta=$this->contexto->get('pergunta');
        $usuario=$this->sessao->get('nome');
        $idProd=$this->sessao->get('idProdutoAtual');
        
        if ($usuario == ""){
            echo '<script>alert(" ' . "Você precisa estar logado!" . '  ");</script>';
            $aux = new Produto;
            $perguntas = $aux->listarMensagens($idProd);
            return $this->response->setContent($this->twig->render('perguntas.html', ['perguntas' => $perguntas]));
        }
        
        $aux = new Produto;
        $aux->inserirPergunta($idProd, $pergunta, $usuario);
        $perguntas = $aux->listarMensagens($idProd);
        
        return $this->response->setContent($this->twig->render('perguntas.html', ['perguntas' => $perguntas]));
        print_r($idProd);
        print_r('oi');
        return;
    }
    
    public function cadastrarProduto(){
        $nomeProd=$this->contexto->get('nomeProd');
        $descricao=$this->contexto->get('descricao');
        $categoria=$this->contexto->get('categoria');
        $troca=$this->contexto->get('troca');
        $vendedor=$this->sessao->get('email');
        $nomeimg = $_FILES['img']['name'];
        if($nomeimg==''){
            echo"Escolha uma imagem!";
            return;
        }
        $temp = $_FILES['img']['tmp_name'];
        $data = date('Y/m/d H:i:s');
        
        if (move_uploaded_file($temp, 'imgs/' . $nomeimg)) {
            $produto = new ProdutoEnt($nomeProd, $descricao, $categoria, $troca, "imgs/".$nomeimg, $vendedor,$data);
            $aux = new Produto;
            $aux->cadastrarProduto($produto);
            
            
        } else {
            echo '<script>alert(" ' . "Erro ao mover imagem!" . '  ");</script>';
        }
        
        
        
        echo $vendedor;
        return;
    }
    
    public function alterarProduto(){
        $idProd = $this->contexto->get('idProd');
        $nomeProd = $this->contexto->get('nomeProd');
        $descricao = $this->contexto->get('descricao');
        $troca=$this->contexto->get('troca');
        $categoria = $this->contexto->get('categoria');
        $vendedor=$this->sessao->get('email');
        $nomeimg = $_FILES['img']['name'];
        $temp = $_FILES['img']['tmp_name'];
        $data = date('Y/m/d H:i:s');//não altera (só por causa do Construtor)
         if($nomeimg==''){
            echo"Escolha uma imagem!";
            return;
        }
        
         if (move_uploaded_file($temp, 'imgs/' . $nomeimg)) {
            $produto = new ProdutoEnt($nomeProd, $descricao, $categoria, $troca, "imgs/".$nomeimg, $vendedor,$data);
            $aux = new Produto;
            $aux->alterarProduto($idProd,$produto);
            
            
        } else {
            echo '<script>alert(" ' . "Erro ao mover imagem!" . '  ");</script>';
        }

    }
        
    public function pesquisarProdutosPorNome($nome) {
        $nomeProd = $nome;
    
        $modelo = new Produto;
        $produtos = $modelo->buscarProdutosPorNome($nomeProd);
       
        $qtdprodutos = count($produtos);
        $this->sessao->add('qtdprodutos', $qtdprodutos);
        $pagina = 1;
        $this->sessao->add('pagina', $pagina);
        
        $categorias = $modelo->listarCategorias();

        $nomeSessao = $this::retornarNomeSessao();

        $prodPorPagCat = 'nao';

        return $this->response->setContent($this->twig->render('index.html', ['nome' => $nomeSessao, 'produtos' => $produtos,
                            'qtdprodutos' => $qtdprodutos, 'pagina' => $pagina, 'categorias' => $categorias, 
            'prodPorPagCat' => $prodPorPagCat ]));
 
    }
    
    public function exluirProduto($id){
         $aux = new Produto;
         $aux->excluirProduto($id);
        echo "<script>window.location='/meusAnuncios'</script>";
    }


    public function retornarNomeSessao() {
        if (isset($_SESSION['nome'])) {
            $nomeSessao = $_SESSION['nome'];
        } else {
            $nomeSessao = 'FAZER LOGIN';
        }
        return $nomeSessao;
    }
    
    public function enviarEmail(){
        $toemail = $this->contexto->get('email');
        $msg = $this->contexto->get('textArea');
        
        if (mail($toemail, "Produto do site catira", $msg)){
            echo 'Enviado';
        }
        else{
            echo"Nao enviado!";
        }
    }

}
