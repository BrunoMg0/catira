<?php

namespace catira;

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\NoConfigurationException;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use catira\Util\Sessao;

$sessao = new Sessao();
$sessao->start();

$loader = new FilesystemLoader('../src/Visoes/');


$twig = new Environment($loader);

include 'rotas.php';

$response = new Response();
$request = Request::createFromGlobals();
$contexto = new RequestContext();
$contexto->fromRequest(Request::createFromGlobals());
$matcher = new UrlMatcher($rotas, $contexto);

try {
    $configRota = $matcher->match($contexto->getPathInfo());
    $controlador = $configRota['controlador'];
    $objeto = new $controlador($response,$request,$twig, $sessao);
    $metodo = $configRota['metodo'];
    if (isset($configRota['parametro'])) {

        $objeto->$metodo($configRota['parametro']);
    } else {
        $objeto->$metodo();
    }
} catch (ResourceNotFoundException $ex) {
    $objeto = new ControladorUsuarios($response, $twig);
    $objeto->padrao();
}

$response->send();



