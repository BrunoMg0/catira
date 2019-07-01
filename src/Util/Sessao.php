<?php

namespace catira\Util;

class Sessao{
     function __construct() {
         
     }
     
     function start() {
        return session_start();
    }

    public function add($chave, $valor) {
        $_SESSION[$chave] = $valor;
    }

    public function get($chave) {
        if (isset($_SESSION[$chave]))
            return $_SESSION[$chave];
        return '';
    }

    public function remove($chave) {
        if (isset($_SESSION['catira'][$chave]))
            session_unset($_SESSION['catira'][$chave]);
    }

    function del() {
        if (isset($_SESSION['catira']))
            session_unset($_SESSION['catira']);
        session_destroy();
    }

    function existe($chave) {
        if (isset($_SESSION['catira'][$chave]))
            return true;
        return false;
    }
             
}
