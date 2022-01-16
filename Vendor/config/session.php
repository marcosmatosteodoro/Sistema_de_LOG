<?php

function entrarSession($id, $nome, $sobrenome, $usuario){
    session_start();
    $_SESSION["id_user"] = $id;
    $_SESSION["nome"] = $nome;
    $_SESSION["sobrenome"] = $sobrenome;
    $_SESSION["usuario"] = $usuario;
    $_SESSION["log"] = true;



    return "$nome $sobrenome está logado.";
}

function sairSession(){
    session_unset();
    session_abort();
    return "Sua sessão foi fechada";
}
?>