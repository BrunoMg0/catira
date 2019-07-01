<?php
namespace catira\Entidades;

class ProdutoEnt{
    private $nome;
    private $descricao;
    private $categoria;
    private $descricao_troca;
    private $caminho_img;
    private $vendedor;
    private $data;
    
    function __construct($nome, $descricao, $categoria, $descricao_troca, $caminho_img, $vendedor,$data) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->descricao_troca = $descricao_troca;
        $this->caminho_img = $caminho_img;
        $this->vendedor = $vendedor;
        $this->data = $data;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getDescricao_troca() {
        return $this->descricao_troca;
    }

    function getCaminho_img() {
        return $this->caminho_img;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setDescricao_troca($descricao_troca) {
        $this->descricao_troca = $descricao_troca;
    }

    function setCaminho_img($caminho_img) {
        $this->caminho_img = $caminho_img;
    }

    function getVendedor() {
        return $this->vendedor;
    }

    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }



    
}