<?php

namespace catira;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;


$rotas = new RouteCollection();

//TELA INICIAL
$rotas->add('/',new Route('/',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' => 'telainicial'
    
    ]));
//PRODUTO
$rotas->add('produto',new Route('/produto/{parametro}',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' => 'telaProduto'
    ]));


$rotas->add('pageProd',new Route('/pageProd',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'produtosporPagina', ['parametro'=>'.*']
    ]));

$rotas->add('prodsCat',new Route('/produtosPorCategoria/{parametro}',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'produtosPorCategoria'
    ]));

$rotas->add('prodsPorNome',new Route('/pesquisarProdutosPorNome/{parametro}',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'pesquisarProdutosPorNome'
    ]));

$rotas->add('cadProd',new Route('/cadProd',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'telaCadProd'
    ]));
$rotas->add('cadastrarProduto',new Route('/cadastrarProduto',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'cadastrarProduto'
    ]));
$rotas->add('pergunta',new Route('/perguntar',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'perguntar'
    ]));
$rotas->add('alterarProduto',new Route('/alterarProduto',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'alterarProduto'
    ]));
$rotas->add('excluirProduto',new Route('/excluirProduto/{parametro}',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'exluirProduto'
    ]));
$rotas->add('exibirDiv',new Route('/exibirDiv',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'exibirDiv'
    ]));

//Tela Editar Produto
$rotas->add('telaEditarProduto',new Route('/telaEditarProduto/{parametro}',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'telaEditarProd'
    ]));

//Login
$rotas->add('logar',new Route('/logar',['controlador'=>'catira\Controladores\ControladorUsuarios',
    'metodo' => 'logar'
    ]));

$rotas->add('login',new Route('/login',['controlador'=>'\catira\Controladores\ControladorTelas',
    'metodo' => 'telaLogin'
    
    ]));
$rotas->add('logout',new Route('/logout',['controlador'=>'\catira\Controladores\ControladorUsuarios',
    'metodo' => 'logout'
    
    ]));


//Cadastro
$rotas->add('cadastro',new Route('/cadastro',['controlador'=>'\catira\Controladores\ControladorTelas',
    'metodo' => 'abrirCadastro'
    
    ]));
$rotas->add('cadastrar',new Route('/cadastrar',['controlador'=>'\catira\Controladores\ControladorUsuarios',
    'metodo' => 'cadastrar'
    ]));


//Cadastro produto trocar Imagem
$rotas->add('trocarimg',new Route('/trocarimg',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'trocarimg'
    ]));

//Meus Anúncios
$rotas->add('meusAnuncios',new Route('/meusAnuncios',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'mostrarTelaAnuncios'
    ]));
//Meus Dados
$rotas->add('meusDados',new Route('/meusDados',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'mostrarTelaDados'
    ]));
$rotas->add('alterarDados',new Route('/alterarDados',['controlador'=>'catira\Controladores\ControladorUsuarios',
    'metodo' =>'alterarDados'
    ]));
//Alterar Senha
$rotas->add('alterarSenha',new Route('/altSenha',['controlador'=>'catira\Controladores\ControladorUsuarios',
    'metodo' =>'alterarSenha'
    ]));

//Enviar email (tela de anúncios) 
$rotas->add('envEmail',new Route('/envEmail',['controlador'=>'catira\Controladores\ControladorProduto',
    'metodo' =>'enviarEmail'
    ]));

//Contato
$rotas->add('contato',new Route('/contato',['controlador'=>'catira\Controladores\ControladorTelas',
    'metodo' =>'mostrarTelaContatos'
    ]));

return $rotas;