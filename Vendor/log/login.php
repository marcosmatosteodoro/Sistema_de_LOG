<?php

require_once "Vendor/config/bd_usuarios.php";
require_once "Vendor/config/session.php";
require_once 'Vendor/log/login.html';

if(isset($_POST['user_l']) && isset($_POST['pass_l'])){

    $usuario = $_POST['user_l'];
    $senha = $_POST['pass_l'];

    if($usuario == null || $senha == null){
        $message = 'Nenhum campo pode ser nulo!';
    }else{
        $validacao = validarBD($usuario, $senha);
        if($validacao === 0){
            $message = "Usuário ou senha não conferem";
        } elseif($validacao != 1 ){
            $message = "Ops! Algo deu errado";
        }else{
            $query = 1;
            header('Location:http://localhost/php_teste/?p=vizualizacao');
            $dados = puxarDados($usuario);
            $message = entrarSession($dados[0]['id'], $dados[0]['nome'], $dados[0]['sobrenome'], $usuario);
        }
    }
echo $message;
}

?>