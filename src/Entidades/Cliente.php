<?php
namespace catira\Entidades;

class Cliente{
    
        
    private $nome;
    private $email;
    private $senha;
    private $logradouro;
    private $numero;
    private $cidade;
    private $estado;
    private $cep;
    private $telefone;
    
    function __construct($nome, $email, $senha, $logradouro, $numero, $cidade, $estado, $cep, $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->telefone = $telefone;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCep() {
        return $this->cep;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }


    
    
    
}
