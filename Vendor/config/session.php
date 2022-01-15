<?php

function entrarSession($usuario){
    session_start();
    $_SESSION["user"] = $usuario;
    return "$usuario está logado.";
}

function sairSession(){
    session_unset();
    session_abort();
    return "Sua sessão foi fechada";
}
?>